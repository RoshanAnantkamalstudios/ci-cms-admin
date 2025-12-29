<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Home\HomeHeroModel; 
use App\Models\Home\HomeWhyChooseModel; 
use App\Models\Home\OurClientModel; 
class HomeController extends BaseController
{
    protected $heroModel;
    protected $WhyChooseModel;
    protected $ourClientSection;

    
    public function __construct()
    {
        $this->heroModel = new HomeHeroModel();
        $this->WhyChooseModel = new HomeWhyChooseModel();
         $this->ourClientSection = new OurClientModel();
    }
    public function Herosection()
    {
        $hero = $this->heroModel->first();

        if ($hero && !empty($hero['images'])) {
            $hero['images'] = json_decode($hero['images'], true);
        }

        return view('admin/home/heroSection', ['hero' => $hero]);
    }

      public function saveherosection()
    {
        $post  = $this->request->getPost();
        $files = $this->request->getFiles();

        $images = json_decode($post['existing_images'] ?? '[]', true);

        if (!empty($files['hero_images'])) {
            foreach ($files['hero_images'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $name = $file->getRandomName();
                    $file->move('uploads/hero', $name);
                    $images[] = 'uploads/hero/' . $name;
                }
            }
        }

        $data = [
            'small_title' => $post['small_title'],
            'main_title'  => $post['main_title'],
            // 'sub_title'   => $post['sub_title'],
            'description' => $post['description'],
            'button_text' => $post['button_text'],
            'button_link' => $post['button_link'],
            'images'      => json_encode($images),
            'status'      => 1
        ];

        if (!empty($post['id'])) {
            $this->heroModel->update($post['id'], $data);
        } else {
            $this->heroModel->insert($data);
        }

        return redirect()->back()->with('success', 'Hero updated successfully');
    }

        public function getherodata()
    {
        $hero = $this->heroModel
            ->where('status', 1)
            ->first();

        if (!$hero) {
            return $this->response->setStatusCode(404)->setJSON([
                'status'  => false,
                'message' => 'Hero content not found'
            ]);
        }

        // Decode images JSON
        $hero['images'] = !empty($hero['images'])
            ? json_decode($hero['images'], true)
            : [];

        return $this->response->setJSON([
            'status' => true,
            'data'   => $hero
        ]);
    }


    //why choose     
    // public function Whychoosesection()
    // {


    //     return view('admin/home/whyChooseSection');
    // }


     public function Whychoosesection()
    {
        $data['data'] = $this->WhyChooseModel->getData();
     
        return view('admin/home/whyChooseSection',$data);
    }

    public function whychoosesave()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'heading' => 'required|min_length[3]|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Please fill the heading field correctly.');
        }

        try {
            $heading = $this->request->getPost('heading');
            $cardsInput = $this->request->getPost('cards');
            $cardsData = [];

            // Create upload directory if it doesn't exist
            $uploadPath = ROOTPATH . 'public/uploads/cards';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($cardsInput && is_array($cardsInput)) {
                foreach ($cardsInput as $index => $card) {
                    $iconPath = null;

                    // Handle icon upload
                    $iconFile = $this->request->getFile("cards.{$index}.icon");
                    
                    if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
                        // Upload new icon
                        $newName = $iconFile->getRandomName();
                        $iconFile->move($uploadPath, $newName);
                        $iconPath = 'uploads/cards/' . $newName;
                    } elseif (!empty($card['existing_icon'])) {
                        // Keep existing icon
                        $iconPath = $card['existing_icon'];
                    }

                    $cardsData[] = [
                        'icon' => $iconPath,
                        'title' => $card['title'],
                        'description' => $card['description']
                    ];
                }
            }

            // Save data
            if ($this->WhyChooseModel->saveData($heading, $cardsData)) {
                return redirect()->to(base_url('admin/homewhychoose'))->with('success', 'Cards saved successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to save cards!');
            }

        } catch (\Exception $e) {
            log_message('error', 'Cards save error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // public function whychoosedelete($index)
    // {
    //     try {
    //         // Get current data
    //         $data = $this->WhyChooseModel->getData();
            
    //         if (!isset($data['cards'][$index])) {
    //             return redirect()->back()->with('error', 'Card not found!');
    //         }

    //         // Check if at least one card will remain
    //         if (count($data['cards']) <= 1) {
    //             return redirect()->back()->with('error', 'Cannot delete! At least one card is required.');
    //         }

    //         // Delete icon file if exists
    //         if (!empty($data['cards'][$index]['icon'])) {
    //             $iconPath = ROOTPATH . 'public/' . $data['cards'][$index]['icon'];
    //             if (file_exists($iconPath)) {
    //                 unlink($iconPath);
    //             }
    //         }

    //         // Remove card from array
    //         unset($data['cards'][$index]);
            
    //         // Reindex array to maintain continuous indices
    //         $data['cards'] = array_values($data['cards']);

    //         // Save updated data
    //         if ($this->WhyChooseModel->saveData($data['heading'], $data['cards'])) {
    //             return redirect()->to(base_url('admin/cards'))->with('success', 'Card deleted successfully!');
    //         } else {
    //             return redirect()->back()->with('error', 'Failed to delete card!');
    //         }

    //     } catch (\Exception $e) {
    //         log_message('error', 'Card delete error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

     public function whychoosedelete($id)
    {
        $about = $this->model->find($id);

        if ($about) {
            // delete main icon
            if ($about['icon'] && file_exists($about['icon'])) {
                unlink($about['icon']);
            }

            // delete card icons
            $cards = json_decode($about['cards'], true);
            if ($cards) {
                foreach ($cards as $card) {
                    if (!empty($card['icon']) && file_exists($card['icon'])) {
                        unlink($card['icon']);
                    }
                }
            }

            $this->model->delete($id);
        }

        return redirect()->to(base_url('admin/about'))
                         ->with('success', 'Section deleted successfully');
    }

    public function getwhychooseusCards()
    {
        try {
            $data = $this->WhyChooseModel->getData();
            
            // Add full URL to icons
            if (!empty($data['cards'])) {
                foreach ($data['cards'] as &$card) {
                    if (!empty($card['icon'])) {
                        $card['icon'] = base_url($card['icon']);
                    }
                }
            }

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            log_message('error', 'API error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while fetching data'
            ]);
        }
    }


    //our client Section
       public function ourclients()
    {
        // $data['about'] = $this->ourClientSection->first();
        // return view('admin/home/ourclientsSection', $data);
                return view('admin/home/ourclientsSection', [
            'about' => $this->ourClientSection->first()
        ]);
    }


    public function ourclientssave()
    {
        $id = $this->request->getPost('id');

        /* ========= MAIN ICON ========= */
        $iconPath = null;
        $icon = $this->request->getFile('icon');

        if ($icon && $icon->isValid() && !$icon->hasMoved()) {
            $name = $icon->getRandomName();
            $icon->move('uploads/about', $name);
            $iconPath = 'uploads/about/' . $name;
        }

        /* ========= CARDS ========= */
        $cards = [];
        $cardData = $this->request->getPost('cards') ?? [];

        foreach ($cardData as $i => $card) {

            // 🔴 DELETE SPECIFIC CARD
            if (!empty($card['deleted']) && $card['deleted'] == 1) {
                if (!empty($card['old_icon']) && file_exists($card['old_icon'])) {
                    unlink($card['old_icon']);
                }
                continue;
            }

            // SAFE DEFAULTS
            $cardId   = $card['id'] ?? uniqid('c_');
            $iconPathCard = $card['old_icon'] ?? null;

            // Upload card icon
            $file = $this->request->getFile("cards.$i.icon");
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $img = $file->getRandomName();
                $file->move('uploads/about', $img);
                $iconPathCard = 'uploads/about/' . $img;
            }

            $cards[] = [
                'id'               => $cardId,
                'icon'             => $iconPathCard,
                'aboutTitle'       => $card['aboutTitle'] ?? '',
                'aboutDescription' => $card['aboutDescription'] ?? ''
            ];
        }

        /* ========= SAVE ========= */
        $data = [
            'short_title' => $this->request->getPost('short_title'),
            'heading'     => $this->request->getPost('heading'),
            'cards'       => json_encode($cards)
        ];

        if ($iconPath) {
            $data['icon'] = $iconPath;
        }

        $id ? $this->ourClientSection->update($id, $data)
            : $this->ourClientSection->insert($data);

        return redirect()->back()->with('success', 'Saved successfully');
    }
}

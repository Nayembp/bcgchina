<?php

namespace App\Livewire\Backend\Donation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Company;
use App\Models\UserDonation;
use Illuminate\Support\Facades\DB;
class DonationIndex extends Component
{

    public $search;
    public $from;
    public $to;

    public function render()
    {
        $query = UserDonation::query();
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'super-admin'])) {
            $query->where('user_id', $user->id);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('note', 'like', '%' . $this->search . '%');
            });
        }
    
        $donations = $query->with('user')->latest()->paginate(10);
    
        return view('livewire.backend.donation.donation-index', [
            'donations' => $donations,
        ]);
    }
    

    
    public function deletedonation($id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user(); 
            if (!$user->can('donation.delete')) {
                $this->dispatch('toast', message: 'You do not have permission to delete donations!', type: 'error');
                return;
            }
            $donation = UserDonation::with('user')->findOrFail($id); 
            $donationAmount = $donation->amount;
            $donationUser = $donation->user;
            $donationUser->total_donation -= $donationAmount;
            $donationUser->save();
            Company::query()->decrement('balance', $donationAmount);
            $donation->delete();

            DB::commit();

            $this->dispatch('toast', message: 'Donation deleted successfully.', type: 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('toast', message: 'Failed to delete Donation: ' . $e->getMessage(), type: 'error');
            \Log::error('Donation deletion failed: ' . $e->getMessage());
        }
    }
    


}

<?php

namespace App\Livewire\Backend\Donation;

use App\Models\User;
use App\Models\Company;
use App\Models\UserDonation;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class DonationCreate extends Component
{
    public $search = '';
    public $users = [];
    public $selectedUserName = '';

    public $user;
    public $amount;
    public $note;
     
    public function updatedSearch()
    {
        $this->users = User::where('name', 'like', '%' . $this->search . '%')->limit(10)->get();
    }
    
    public function selectUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->user = $user->id;
            $this->selectedUserName = $user->name;
            $this->search = $user->name;
            $this->users = [];
        } else {
            $this->dispatch('toast', message: 'User not found!', type: 'error');
        }
    }
    


    public function rules()
    {
        return [
            'user' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'note' => 'required|string|max:1000',
        ];
    }

    public function save()
    {
        $this->validate();

        if (!$this->user) {
            $this->dispatch('toast', message: 'Please select a valid user.', type: 'error');
            return;
        }

        DB::beginTransaction();

        try {

            $user = User::find($this->user);
            if ($user) {

                $userPreviousBalance = $user->total_donation;
                $userCurrentBalance = $user->total_donation + $this->amount;
                $user->total_donation = $userCurrentBalance;
                $user->save();

                UserDonation::create([
                    'user_id'           => $this->user,
                    'amount'            => $this->amount,
                    'note'              => $this->note,
                    'previous_balance'  => $userPreviousBalance, 
                    'current_balance'   => $userCurrentBalance
                ]);

                Company::query()->increment('balance', $this->amount);
            
            }
    
            DB::commit();

            $this->dispatch('toast', message: 'Donation added successfully!', type: 'success');

            $this->reset(['user', 'amount', 'note', 'search', 'selectedUserName', 'users']);

            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollBack();

            $this->dispatch('toast', message: 'Failed to add donation: ' . $e->getMessage(), type: 'error');

            \Log::error('Failed to add donation: ' . $e->getMessage());
        }
    }


    

    public function render()
    {
        return view('livewire.backend.donation.donation-create');
    }
}

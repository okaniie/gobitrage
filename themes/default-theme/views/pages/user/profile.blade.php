<x-template.user title="Profile" slug="profile">
    <x-user.page-banner>Profile</x-user.page-banner>
    <x-general.flash-bag />
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card bg-dark border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Profile Settings</h5>
                        <p class="text-muted mb-0">Update your profile information and settings below.</p>
                    </div>
                    <div class="card-body">
                        <form method="post" class="row g-4">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="username" class="text-white">Username</label>
                                <input class="form-control bg-dark text-white border-secondary" id="username" type="text" value="{{ $user->username }}" readonly disabled />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="text-white">Full Name</label>
                                <input class="form-control bg-dark text-white border-secondary" id="name" type="text" name="profile[name]" value="{{ $user->name }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="text-white">Email</label>
                                <input class="form-control bg-dark text-white border-secondary" id="email" type="email" name="profile[email]" value="{{ $user->email }}" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="text-white">Phone</label>
                                <input class="form-control bg-dark text-white border-secondary" id="phone" type="text" name="profile[phone]" value="{{ $user->phone }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class="text-white">Address</label>
                                <input class="form-control bg-dark text-white border-secondary" id="address" type="text" name="profile[address]" value="{{ $user->address }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="text-white">New Password (leave blank to keep current)</label>
                                <input class="form-control bg-dark text-white border-secondary" id="password" type="password" name="password[password]" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="text-white">Confirm New Password</label>
                                <input class="form-control bg-dark text-white border-secondary" id="password_confirmation" type="password" name="password[confirmPassword]" />
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card bg-dark border-0 shadow-sm mt-4">
                    <div class="card-header bg-transparent border-0">
                        <h5 class="text-white mb-0">Withdrawal Wallets</h5>
                        <p class="text-muted mb-0">Manage your withdrawal wallet addresses below.</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.profile') }}" class="row g-4">
                            @csrf
                            @foreach ($addresses as $address)
                                <div class="form-group col-md-6">
                                    <label for="{{ $address->currency_code }}" class="text-white">{{ $address->currency_code }} Address</label>
                                    <input class="form-control bg-dark text-white border-secondary" 
                                           id="{{ $address->currency_code }}_address" 
                                           type="text" 
                                           name="deposit_address[{{ $address->currency_code }}]" 
                                           value="{{ $address->deposit_address }}" />
                                </div>
                            @endforeach
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Update Wallets</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-template.user>

<x-template.user title="Profile" slug="profile">
    <x-user.page-banner>Profile</x-user.page-banner>
    <x-general.flash-bag />
    <x-user.section>
        <x-user.section-title>Update Profile</x-user.section-title>
        <x-user.section-description>Make changes to your profile using the form below.</x-user.section-description>
        <x-user.section-body>
            <form id="profile" class="row g-4" method="post">
                @csrf
                <h5 class="mb-0"><u>Basic info</u></h5>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="username">Username</label>
                    <input id="username" class="form-control" readonly disabled value="{{ $user->username }}" />
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="name">Full Name</label>
                    <input id="name" name="profile[name]" value="{{ $user->name }}" class="form-control" />
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="profile[email]" value="{{ $user->email }}"
                        class="form-control" />
                </div>
                <br />
                <h5 class="mb-0"><u>Wallet addresses</u></h5>
                @foreach ($addresses as $address)
                    <div class="form-group col-sm-6 col-md-4">
                        <label for="{{ $address->currency_code }}"> {{ $address->currency_code }} Address</label>
                        <input id="{{ $address->currency_code }}_address" class="form-control"
                            name="deposit_address[{{ $address->currency_code }}]"
                            value="{{ $address->deposit_address }}" />
                    </div>
                @endforeach
                <br />
                <h5 class="mb-0"><u>Password</u></h5>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="email">New Password</label>
                    <input class="form-control" type="text" name="password[password]" />
                    <small>
                        <em>Only fill new password if you want to change password.</em>
                    </small>
                </div>
                <div class="form-group col-sm-6 col-md-4">
                    <label for="email">Confirm New Password</label>
                    <input class="form-control" type="text" name="password[confirmPassword]" />
                    <small>
                        <em>Only fill new password if you want to change password.</em>
                    </small>
                </div>
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </x-user.section-body>
    </x-user.section>
</x-template.user>

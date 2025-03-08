<x-template.guest>
    <section class="section_2 my-5">
        <div class="container text-center">
            <div class="section-heading">
                <h4 class="my-2">Your Deposit was received successfully.</h4>
            </div>
            <div class="row mt-20 text-center mb-50">
                <div class="container">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Back to Account Dashboard</a>
                    <a href="{{ route('user.deposits') }}" class="btn btn-danger">Back to Deposits Page</a>
                </div>
            </div>

        </div>
    </section>
</x-template.guest>

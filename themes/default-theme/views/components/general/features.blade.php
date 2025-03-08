<style>
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .feature-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 4rem;
        height: 4rem;
        margin-bottom: 1rem;
        font-size: 2rem;
        color: #fff;
        border-radius: .75rem;
    }

    .icon-link {
        display: inline-flex;
        align-items: center;
    }

    .icon-link>.bi {
        margin-top: .125rem;
        margin-left: .125rem;
        transition: transform .25s ease-in-out;
        fill: currentColor;
    }

    .icon-link:hover>.bi {
        transform: translate(.25rem);
    }

    .icon-square {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        font-size: 1.5rem;
        border-radius: .75rem;
    }

    .rounded-4 {
        border-radius: .5rem;
    }

    .rounded-5 {
        border-radius: 1rem;
    }

    .text-shadow-1 {
        text-shadow: 0 .125rem .25rem rgba(0, 0, 0, .25);
    }

    .text-shadow-2 {
        text-shadow: 0 .25rem .5rem rgba(0, 0, 0, .25);
    }

    .text-shadow-3 {
        text-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .25);
    }

    .card-cover {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
</style>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Features</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#collection" />
                </svg>
            </div>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                and probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#people-circle" />
                </svg>
            </div>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                and probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#toggles2" />
                </svg>
            </div>
            <h2>Featured title</h2>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                and probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
    </div>
</div>

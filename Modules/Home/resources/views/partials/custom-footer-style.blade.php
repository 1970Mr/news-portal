<style>
    .footer-row {
        display: flex;
        gap: 6rem;
        justify-content: space-between;
    }

    .footer-row > div:nth-child(1) {
        flex-grow: 3;
    }

    .footer-row > div:nth-child(2) {
        flex-grow: 8;
        display: flex;
        gap: 6rem;
    }

    .footer-row > div:nth-child(2) > .footer-widget:nth-child(1) {
        flex-grow: 2;
    }

    .footer-row > div:nth-child(2) > .footer-widget:nth-child(2) {
        flex-grow: 3;
    }

    .footer-widget a:hover {
        color: #ec0000;
    }

    .footer-row a {
        display: block;
    }

    .footer-row h3 {
        white-space: nowrap;
    }

    .footer .post-thumb img {
        height: 75px;
    }

    .footer .list-post-block {
        width: 100%;
    }

    .footer .list-post-block .list-post {
        display: flex;
        flex-direction: column;
    }

    @media screen and (max-width: 768px) {
        .footer-row {
            flex-wrap: wrap;
            padding: 0 2.5rem;
        }

        .footer-row > div:nth-child(1) {
            flex-basis: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-row > div:nth-child(2) {
            flex-wrap: nowrap;
        }

        .footer-row > div:nth-child(2) > .footer-widget {
            flex-basis: 50%;
        }

        .footer-row > div:nth-child(2) .post-thumb {
            display: none;
        }

        .footer-row > div:nth-child(2) a {
            font-size: 12px;
        }

        .footer-row > div:nth-child(2) h3 {
            font-size: 14px !important;
        }

        .widget-editor-choices {
            width: 80%;
            margin: 0 auto 3rem;
        }

        .widget-categories {
            order: 2;
        }
    }
</style>

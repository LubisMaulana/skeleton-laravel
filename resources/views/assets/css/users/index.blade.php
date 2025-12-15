<style>
    label {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-body {
        max-height: 70vh;
    }

    @media only screen and (max-width: 768px) {
        .container {
            max-width: 800px;
            width: 90%;
        }
    }

    @media only screen and (max-width: 656px) {
        .container {
            margin-left: 0px !important;
            margin-right: 0px !important;
            width: 100%;
        }
    }

    @media (min-width: 576px) {

        .container-sm,
        .container {
            max-width: 100% !important;
        }
    }

    @media (min-width: 768px) {

        .container-md,
        .container-sm,
        .container {
            max-width: 100% !important;
        }
    }

    @media (min-width: 992px) {

        .container-lg,
        .container-md,
        .container-sm,
        .container {
            width: 100% !important;
            max-width: 1500px !important;
        }
    }
</style>

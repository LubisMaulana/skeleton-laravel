<style>
    #table-data_wrapper {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        gap: 15px;
        margin-top: 5px;
    }

    #table-data th {
        white-space: nowrap;
    }

    .dataTables_length {
        display: flex;
    }

    #table-data_filter {
        display: flex;
        justify-content: flex-end;
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
    }

    .sorting:hover {
        cursor: pointer;
    }

    .table-responsive {
        width: 100%;
        position: relative;
        overflow-x: hidden;
    }

    .table-responsive .row:first-child {
        width: calc(100% + 22px);
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 2;
    }

    .table-responsive .row:nth-child(2) {
        width: calc(100% + 22px);
        overflow-x: auto;
    }

    .table-responsive .row:nth-child(2) .col-sm-12 {
        padding-left: 0px;
        padding-right: 0px;
    }

    .table-responsive .row:nth-child(3) {
        width: calc(100% + 22px);
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 2;
    }

    .col-sm-12.col-md-6:nth-child(2) {
        padding-right: 0px;
    }

    .col-sm-12.col-md-5 {
        padding-left: 0px;
    }

    .col-sm-12.col-md-7:nth-child(2) {
        padding-right: 0px;
    }

    #table-data_wrapper .row:first-child:first-child .col-sm-12.col-md-6:first-child {
        padding: 0px;
    }

    #table-data_wrapper>.row>.col-sm-12:nth-child(2) {
        min-width: 232px !important;
        max-width: 100% !important;
    }

    #table-data_wrapper>.row {
        display: flex;
        justify-content: space-between;
    }

    .page-link {
        color: #48a39e !important;
    }

    .disabled>.page-link {
        color: rgba(33, 37, 41, 0.75) !important;
    }

    .active>.page-link,
    .page-link.active {
        border-color: #48a39e !important;
        background-color: #48a39e !important;
        color: white !important;
    }

    @media only screen and (max-width: 768px) {
        .row:first-child {
            justify-content: space-between;
            gap: 10px;
        }

        #table-data_filter {
            justify-content: flex-start;
        }

        #table-data_wrapper>.row>.col-sm-12:nth-child(2) {
            padding-left: 0px;
        }

        .col-sm-12.col-md-5 {
            display: none;
        }

        .col-sm-12.col-md-6:first-child {
            min-width: 200px;
        }

        .col-sm-12.col-md-6:nth-child(2) {
            min-width: 280px;
        }

        .col-sm-12.col-md-6 {
            width: 45%;
            padding-right: 0px;
        }

        .col-sm-12.col-md-7 {
            padding-left: 0px;
            padding-right: 0px;
        }
    }

    @media only screen and (max-width: 656px) {
        #table-data_filter {
            justify-content: flex-start;
        }
    }
</style>

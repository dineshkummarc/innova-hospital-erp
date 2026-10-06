<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Chart</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</head>

<style>
    .excel-container {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 20px;
        margin: 20px 0;
    }

    .excel-toolbar {
        background: #e9ecef;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .excel-toolbar .btn {
        margin-right: 5px;
    }

    .excel-table {
        background: white;
        border: 1px solid #dee2e6;
    }

    .excel-table th {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .excel-table td {
        border: 1px solid #dee2e6;
    }

    .excel-table tr:hover {
        background: #f8f9fa;
    }

    .excel-footer {
        background: #e9ecef;
        padding: 10px;
        border-radius: 4px;
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
    }

    .sheet-tabs {
        display: flex;
        background: #e9ecef;
        padding: 5px;
        border-radius: 4px;
        margin-top: 10px;
    }

    .sheet-tab {
        padding: 5px 15px;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        margin-right: 5px;
        cursor: pointer;
    }

    .sheet-tab.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .formula-bar {
        padding: 5px;
        background: white;
        border: 1px solid #dee2e6;
        margin: 10px 0;
    }

    .cell-address {
        width: 100px;
        border-right: 1px solid #dee2e6;
        padding: 5px;
        display: inline-block;
    }

    .formula-input {
        width: calc(100% - 110px);
        border: none;
        padding: 5px;
        outline: none;
    }
</style>

<div class="excel-container">



    <body>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">Business Analytics</h3>
                            </div>
                            <div class="card-body">
                                <table id="business_table" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Purchase Price</th>
                                            <th>Cost</th>
                                            <th>Sell Price (Tk)</th>
                                            <th>Profit</th>
                                            <th>Profit %</th>
                                            <th>Quantity</th>
                                            <th>Total Costing (Tk)</th>
                                            <th>Total Sell (Tk)</th>
                                            <th>Total Profit (Tk)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Glass Products -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Glass Products</strong></td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Rainbow Glass</td>
                                            <td>10</td>
                                            <td>5</td>
                                            <td>32</td>
                                            <td>17</td>
                                            <td>113%</td>
                                            <td>100</td>
                                            <td>1,500</td>
                                            <td>3,200</td>
                                            <td>1,700</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>5D Glass</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>19</td>
                                            <td>9</td>
                                            <td>90%</td>
                                            <td>100</td>
                                            <td>1,000</td>
                                            <td>1,900</td>
                                            <td>900</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>MM Glass</td>
                                            <td>5</td>
                                            <td>5</td>
                                            <td>15</td>
                                            <td>5</td>
                                            <td>50%</td>
                                            <td>100</td>
                                            <td>1,000</td>
                                            <td>1,500</td>
                                            <td>500</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Rainbow Glass (Original)</td>
                                            <td>20</td>
                                            <td>5</td>
                                            <td>50</td>
                                            <td>25</td>
                                            <td>100%</td>
                                            <td>100</td>
                                            <td>2,500</td>
                                            <td>5,000</td>
                                            <td>2,500</td>
                                        </tr>

                                        <!-- Earphones -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Earphones</strong></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Earphone (Low)</td>
                                            <td>15</td>
                                            <td>5</td>
                                            <td>36</td>
                                            <td>16</td>
                                            <td>80%</td>
                                            <td>100</td>
                                            <td>2,000</td>
                                            <td>3,600</td>
                                            <td>1,600</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Remax Earphone</td>
                                            <td>90</td>
                                            <td>5</td>
                                            <td>170</td>
                                            <td>75</td>
                                            <td>79%</td>
                                            <td>100</td>
                                            <td>9,500</td>
                                            <td>17,000</td>
                                            <td>7,500</td>
                                        </tr>

                                        <!-- Bluetooth Earphones -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Bluetooth Earphones</strong></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Bluetooth Earphone (Awaye)</td>
                                            <td>700</td>
                                            <td>5</td>
                                            <td>1,200</td>
                                            <td>495</td>
                                            <td>70%</td>
                                            <td>100</td>
                                            <td>70,500</td>
                                            <td>120,000</td>
                                            <td>49,500</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Bluetooth Earphone (Normal)</td>
                                            <td>150</td>
                                            <td>5</td>
                                            <td>250</td>
                                            <td>95</td>
                                            <td>61%</td>
                                            <td>100</td>
                                            <td>15,500</td>
                                            <td>25,000</td>
                                            <td>9,500</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Bluetooth Earphone M10</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>300</td>
                                            <td>95</td>
                                            <td>46%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>30,000</td>
                                            <td>9,500</td>
                                        </tr>

                                        <!-- Apple Bluetooth Earphones -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Apple Bluetooth Earphones</strong></td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Apple Bluetooth Earphone</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>400</td>
                                            <td>195</td>
                                            <td>95%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>40,000</td>
                                            <td>19,500</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>Apple Bluetooth Earphone</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>550</td>
                                            <td>345</td>
                                            <td>168%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>55,000</td>
                                            <td>34,500</td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Apple Bluetooth Earphone</td>
                                            <td>500</td>
                                            <td>5</td>
                                            <td>700</td>
                                            <td>195</td>
                                            <td>39%</td>
                                            <td>100</td>
                                            <td>50,500</td>
                                            <td>70,000</td>
                                            <td>19,500</td>
                                        </tr>

                                        <!-- Neckbands -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Neckbands</strong></td>
                                        </tr>
                                        <tr>
                                            <td>13</td>
                                            <td>Neckband</td>
                                            <td>70</td>
                                            <td>5</td>
                                            <td>150</td>
                                            <td>75</td>
                                            <td>100%</td>
                                            <td>100</td>
                                            <td>7,500</td>
                                            <td>15,000</td>
                                            <td>7,500</td>
                                        </tr>
                                        <tr>
                                            <td>14</td>
                                            <td>Neckband</td>
                                            <td>150</td>
                                            <td>5</td>
                                            <td>300</td>
                                            <td>145</td>
                                            <td>94%</td>
                                            <td>100</td>
                                            <td>15,500</td>
                                            <td>30,000</td>
                                            <td>14,500</td>
                                        </tr>
                                        <tr>
                                            <td>15</td>
                                            <td>Neckband</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>450</td>
                                            <td>245</td>
                                            <td>119%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>45,000</td>
                                            <td>24,500</td>
                                        </tr>
                                        <tr>
                                            <td>16</td>
                                            <td>Neckband (High)</td>
                                            <td>700</td>
                                            <td>5</td>
                                            <td>1,250</td>
                                            <td>545</td>
                                            <td>77%</td>
                                            <td>100</td>
                                            <td>70,500</td>
                                            <td>125,000</td>
                                            <td>54,500</td>
                                        </tr>

                                        <!-- One Plus Neckbands -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>One Plus Neckbands</strong></td>
                                        </tr>
                                        <tr>
                                            <td>17</td>
                                            <td>One Plus Neckband</td>
                                            <td>2,000</td>
                                            <td>5</td>
                                            <td>2,450</td>
                                            <td>445</td>
                                            <td>22%</td>
                                            <td>100</td>
                                            <td>200,500</td>
                                            <td>245,000</td>
                                            <td>44,500</td>
                                        </tr>
                                        <tr>
                                            <td>18</td>
                                            <td>One Plus Neckband</td>
                                            <td>2,000</td>
                                            <td>5</td>
                                            <td>2,600</td>
                                            <td>595</td>
                                            <td>30%</td>
                                            <td>100</td>
                                            <td>200,500</td>
                                            <td>260,000</td>
                                            <td>59,500</td>
                                        </tr>

                                        <!-- Bluetooth Boxes -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Bluetooth Boxes</strong></td>
                                        </tr>
                                        <tr>
                                            <td>19</td>
                                            <td>Bluetooth Box</td>
                                            <td>700</td>
                                            <td>5</td>
                                            <td>1,250</td>
                                            <td>545</td>
                                            <td>77%</td>
                                            <td>100</td>
                                            <td>70,500</td>
                                            <td>125,000</td>
                                            <td>54,500</td>
                                        </tr>
                                        <tr>
                                            <td>20</td>
                                            <td>Bluetooth Box</td>
                                            <td>800</td>
                                            <td>5</td>
                                            <td>1,400</td>
                                            <td>595</td>
                                            <td>74%</td>
                                            <td>100</td>
                                            <td>80,500</td>
                                            <td>140,000</td>
                                            <td>59,500</td>
                                        </tr>

                                        <!-- Type C Chargers -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Type C Chargers</strong></td>
                                        </tr>
                                        <tr>
                                            <td>21</td>
                                            <td>Charger Type C 18W</td>
                                            <td>150</td>
                                            <td>5</td>
                                            <td>280</td>
                                            <td>125</td>
                                            <td>81%</td>
                                            <td>100</td>
                                            <td>15,500</td>
                                            <td>28,000</td>
                                            <td>12,500</td>
                                        </tr>
                                        <tr>
                                            <td>22</td>
                                            <td>Charger Type C 25W</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>300</td>
                                            <td>95</td>
                                            <td>46%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>30,000</td>
                                            <td>9,500</td>
                                        </tr>
                                        <tr>
                                            <td>23</td>
                                            <td>Charger Type C 33W</td>
                                            <td>200</td>
                                            <td>5</td>
                                            <td>400</td>
                                            <td>195</td>
                                            <td>95%</td>
                                            <td>100</td>
                                            <td>20,500</td>
                                            <td>40,000</td>
                                            <td>19,500</td>
                                        </tr>
                                        <tr>
                                            <td>24</td>
                                            <td>Charger Type C 44W</td>
                                            <td>300</td>
                                            <td>5</td>
                                            <td>570</td>
                                            <td>265</td>
                                            <td>87%</td>
                                            <td>100</td>
                                            <td>30,500</td>
                                            <td>57,000</td>
                                            <td>26,500</td>
                                        </tr>
                                        <tr>
                                            <td>25</td>
                                            <td>Charger Type C 65W</td>
                                            <td>400</td>
                                            <td>5</td>
                                            <td>700</td>
                                            <td>295</td>
                                            <td>73%</td>
                                            <td>100</td>
                                            <td>40,500</td>
                                            <td>70,000</td>
                                            <td>29,500</td>
                                        </tr>
                                        <tr>
                                            <td>26</td>
                                            <td>Charger Type C 80W</td>
                                            <td>500</td>
                                            <td>5</td>
                                            <td>800</td>
                                            <td>295</td>
                                            <td>58%</td>
                                            <td>100</td>
                                            <td>50,500</td>
                                            <td>80,000</td>
                                            <td>29,500</td>
                                        </tr>

                                        <!-- Data Cables Type B -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Data Cables Type B</strong></td>
                                        </tr>
                                        <tr>
                                            <td>27</td>
                                            <td>Data Cable Type B</td>
                                            <td>10</td>
                                            <td>5</td>
                                            <td>30</td>
                                            <td>15</td>
                                            <td>100%</td>
                                            <td>100</td>
                                            <td>1,500</td>
                                            <td>3,000</td>
                                            <td>1,500</td>
                                        </tr>
                                        <tr>
                                            <td>28</td>
                                            <td>Data Cable Type B</td>
                                            <td>35</td>
                                            <td>5</td>
                                            <td>70</td>
                                            <td>30</td>
                                            <td>75%</td>
                                            <td>100</td>
                                            <td>3,500</td>
                                            <td>7,000</td>
                                            <td>3,000</td>
                                        </tr>
                                        <tr>
                                            <td>29</td>
                                            <td>Data Cable Type B</td>
                                            <td>40</td>
                                            <td>5</td>
                                            <td>80</td>
                                            <td>35</td>
                                            <td>78%</td>
                                            <td>100</td>
                                            <td>4,500</td>
                                            <td>8,000</td>
                                            <td>3,500</td>
                                        </tr>

                                        <!-- Data Cables Type C -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Data Cables Type C</strong></td>
                                        </tr>
                                        <tr>
                                            <td>30</td>
                                            <td>Data Cable Type C</td>
                                            <td>35</td>
                                            <td>5</td>
                                            <td>70</td>
                                            <td>30</td>
                                            <td>75%</td>
                                            <td>100</td>
                                            <td>3,500</td>
                                            <td>7,000</td>
                                            <td>3,000</td>
                                        </tr>
                                        <tr>
                                            <td>31</td>
                                            <td>Data Cable Type C</td>
                                            <td>40</td>
                                            <td>5</td>
                                            <td>80</td>
                                            <td>35</td>
                                            <td>78%</td>
                                            <td>100</td>
                                            <td>4,500</td>
                                            <td>8,000</td>
                                            <td>3,500</td>
                                        </tr>
                                        <tr>
                                            <td>32</td>
                                            <td>Data Cable Type C</td>
                                            <td>70</td>
                                            <td>5</td>
                                            <td>150</td>
                                            <td>75</td>
                                            <td>100%</td>
                                            <td>100</td>
                                            <td>7,500</td>
                                            <td>15,000</td>
                                            <td>7,500</td>
                                        </tr>
                                        <tr>
                                            <td>33</td>
                                            <td>Data Cable Type C</td>
                                            <td>100</td>
                                            <td>5</td>
                                            <td>170</td>
                                            <td>65</td>
                                            <td>62%</td>
                                            <td>100</td>
                                            <td>10,500</td>
                                            <td>17,000</td>
                                            <td>6,500</td>
                                        </tr>

                                        <!-- Smart Watches -->
                                        <tr class="bg-light">
                                            <td colspan="11"><strong>Smart Watches</strong></td>
                                        </tr>
                                        <tr>
                                            <td>34</td>
                                            <td>Smart Watch (Low)</td>
                                            <td>450</td>
                                            <td>5</td>
                                            <td>700</td>
                                            <td>245</td>
                                            <td>54%</td>
                                            <td>100</td>
                                            <td>45,500</td>
                                            <td>70,000</td>
                                            <td>24,500</td>
                                        </tr>
                                        <tr>
                                            <td>35</td>
                                            <td>Smart Watch (High)</td>
                                            <td>800</td>
                                            <td>5</td>
                                            <td>1,450</td>
                                            <td>645</td>
                                            <td>80%</td>
                                            <td>100</td>
                                            <td>80,500</td>
                                            <td>145,000</td>
                                            <td>64,500</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-info text-white font-weight-bold">
                                            <td></td>
                                            <td>Grand Total</td>
                                            <td>12,045</td>
                                            <td>175</td>
                                            <td>19,422</td>
                                            <td>7,202</td>
                                            <td>59%</td>
                                            <td>3,600</td>
                                            <td>1,222,000</td>
                                            <td>1,947,000</td>
                                            <td>720,200</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#business_table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    "pageLength": 25,
                    "order": [
                        [0, "asc"]
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "No matching records found",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "search": "Search:",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Previous"
                        }
                    }
                });
            });
        </script>







        <script>
            $(document).ready(function() {
                $('#investment_table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    "pageLength": 25,
                    "order": [
                        [0, "asc"]
                    ],
                    "language": {
                        "lengthMenu": "Show _MENU_ entries",
                        "zeroRecords": "No matching records found",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "Showing 0 to 0 of 0 entries",
                        "infoFiltered": "(filtered from _MAX_ total entries)",
                        "search": "Search:",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Previous"
                        }
                    }
                });
            });
        </script>
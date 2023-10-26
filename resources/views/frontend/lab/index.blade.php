@extends('frontend.master')

@section('content')
    <main>
        <div class="container">
            <!-- search lab start -->
            <section class="search-container">
                <h3 class="title text-center lab-name">BFSA Laboratory</h3>
                <div class="lab-details">
                    <div class="card text-bg-dark bg-white border-0">
                        <div class="lab-details-img">
                            <img src="./assets/image/bfsa.jpeg" class="card-img" alt="..." />
                        </div>
                        <div class="card-img-overlay lab-details">
                            <div class="left-side-lab"></div>
                            <div class="right-side-lab">
                                <div class="bg-white p-2 p-md-4 shadow-lg rounded contact-content">
                                    <h3 class="contactDetails-title">Contact Details</h3>
                                    <div>
                                        <p class="lab-name-contnet">
                                            <span class="contact-info-title">Lab Name:</span> BSCIC
                                            Salt Testing Laboratory
                                        </p>
                                        <p class="lab-name-contnet">
                                            <span class="contact-info-title">Address:</span> BSL
                                            Office Complex (Beside Hotel InterContinental Dhaka),
                                            Bhaban 2, (Level 4,5,6), 119 Kazi Nazrul Islam Avenue,
                                            Dhaka-1000
                                        </p>
                                        <p class="lab-name-contnet">
                                            <span class="contact-info-title">Email:</span>
                                            info@bfsa.gov.bd
                                        </p>
                                        <p class="lab-name-contnet">
                                            <span class="contact-info-title">Phone:</span>
                                            +8802-222223459
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- search lab end -->

            <!-- lab tap start -->
            <section class="tab-section">
                <!-- Nav tabs -->

                <ul class="nav nav-pills tap-grid">
                    <li class="nav-item">
                        <a class="nav-link tap-link" data-bs-toggle="pill" href="#availableService">
                            Available Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tap-link" data-bs-toggle="pill" href="#priceChart">
                            Price Chart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tap-link" data-bs-toggle="pill" href="#insFaclities">
                            instrument facilities
                        </a>
                    </li>
                </ul>

                <!-- tap panel -->
                <div class="tab-content">
                    <!-- available service -->
                    <div class="tab-pane fade" id="availableService">
                        <div class="mt-5">
                            <div class="mb-3 d-flex justify-content-end">
                                <input class="select-input rounded" type="text" placeholder="Test Name" />
                            </div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table border table-custom">
                                    <thead class="text-nowrap">
                                        <tr class="table-th-tr">
                                            <th scope="col" class="table-th">SL.NO.</th>
                                            <th scope="col" class="table-th">Test Name</th>
                                            <th scope="col" class="table-th">Parameter</th>
                                            <th scope="col" class="table-th">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-td text-center"><span>1</span></td>
                                            <td class="table-td text-center">
                                                <span>Water</span>
                                            </td>
                                            <td class="table-td w-50">
                                                <span>Gamma Spectrometry Laboratory (GSL)- radiation
                                                    protection, radioactivity monitoring of imported and
                                                    exportable food and allied materials, and
                                                    radiological emergency activities.</span>
                                            </td>
                                            <td class="table-td text-center">
                                                <span>Accredited</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-td text-center"><span>2</span></td>
                                            <td class="table-td text-center">
                                                <span>Fish</span>
                                            </td>
                                            <td class="table-td">
                                                <span>Lead (Pb), Cadmium (Cd), Chromium (Cr), Arsenic
                                                    (As), Mercury (Hg),Copper (Cu), Iron(Fe), Manganese
                                                    (Mn), Zinc (Zn), Nickel (Ni), Cobalt (Co), Calcium
                                                    (Ca), Magnesium (Mg), Sodium (Na), Potassium (K),
                                                </span>
                                            </td>
                                            <td class="table-td text-center">
                                                <span>Not Accredited</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- price chart -->
                    <div class="tab-pane fade" id="priceChart">
                        <div class="mt-5">
                            <div class="mb-3 d-flex justify-content-end">
                                <input class="select-input rounded" type="text" placeholder="Test Name" />
                            </div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table border table-custom">
                                    <thead class="text-nowrap">
                                        <tr class="table-th-tr">
                                            <th scope="col" class="table-th">SL.NO.</th>
                                            <th scope="col" class="table-th">Test Name</th>
                                            <th scope="col" class="table-th">Parameter</th>
                                            <th scope="col" class="table-th">Price</th>
                                            <th scope="col" class="table-th">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-td text-center"><span>1</span></td>
                                            <td class="table-td text-center">
                                                <span>Water</span>
                                            </td>
                                            <td class="table-td w-50">
                                                <span>Gamma Spectrometry Laboratory (GSL)- radiation
                                                    protection, radioactivity monitoring of imported and
                                                    exportable food and allied materials, and
                                                    radiological emergency activities.</span>
                                            </td>
                                            <td class="table-td text-center fw-semibold">
                                                <span><span>2500</span>TK</span>
                                            </td>
                                            <td class="table-td text-center">
                                                <div>
                                                    <button class="btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#availableModal">
                                                        Break Down
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-td text-center"><span>2</span></td>
                                            <td class="table-td text-center">
                                                <span>Fish</span>
                                            </td>
                                            <td class="table-td">
                                                <span>Lead (Pb), Cadmium (Cd), Chromium (Cr), Arsenic
                                                    (As), Mercury (Hg),Copper (Cu), Iron(Fe), Manganese
                                                    (Mn), Zinc (Zn), Nickel (Ni), Cobalt (Co), Calcium
                                                    (Ca), Magnesium (Mg), Sodium (Na), Potassium (K),
                                                </span>
                                            </td>
                                            <td class="table-td text-center fw-semibold">
                                                <span><span>2000</span>TK</span>
                                            </td>
                                            <td class="table-td text-center">
                                                <div>
                                                    <button class="btn-view" data-bs-toggle="modal"
                                                        data-bs-target="#availableModal">
                                                        Break Down
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- parameters modal -->
                            <div class="modal fade" id="availableModal" tabindex="-1"
                                aria-labelledby="availableModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="availableModalLabel">
                                                Fish
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive mt-3">
                                                <table class="table border table-custom">
                                                    <thead class="table-warp">
                                                        <tr class="table-th-tr">
                                                            <th scope="col" class="table-th">Parameters</th>

                                                            <th scope="col" class="table-th">Charge</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-warp">
                                                        <tr>
                                                            <td class="table-td text-center">Lead (Pb)</td>

                                                            <td class="table-td text-center fw-semibold">
                                                                <span>1500</span>TK
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="table-td text-center">
                                                                Cadmium (Cd)
                                                            </td>

                                                            <td class="table-td text-center fw-semibold">
                                                                <span>3000</span>TK
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="table-td text-center">
                                                                Chromium (Cr)
                                                            </td>

                                                            <td class="table-td text-center fw-semibold">
                                                                <span>1000</span>TK
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="table-td text-center">
                                                                Mercury (Hg)
                                                            </td>

                                                            <td class="table-td text-center fw-semibold">
                                                                <span>2500</span>TK
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- facilities -->
                    <div class="tab-pane fade" id="insFaclities">
                        <!-- table -->
                        <div class="table-responsive mt-5">
                            <table class="table border table-custom">
                                <thead class="text-nowrap">
                                    <tr class="table-th-tr">
                                        <th scope="col" class="table-th text-center">SL.NO.</th>
                                        <th scope="col" class="table-th text-center">
                                            Instrument Name
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">
                                    <tr>
                                        <td class="table-td text-center">1</td>
                                        <td class="table-td text-center">
                                            Membrane Filtration Unit
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-td text-center">2</td>
                                        <td class="table-td text-center">
                                            Conventional PCR Machine
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-td text-center">3</td>
                                        <td class="table-td text-center">
                                            Real -Time PCR Machine
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-td text-center">4</td>
                                        <td class="table-td text-center">Gel Imaging System</td>
                                    </tr>
                                    <tr>
                                        <td class="table-td text-center">5</td>
                                        <td class="table-td text-center">Biosafety Cabinet</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!-- lab tap end -->

            <!-- lab-details start -->
            <section class="tab-section">
                <!-- table -->
                <div class="table-responsive">
                    <table class="table border table-bordered border-success">
                        <tbody>
                            <tr>
                                <td class="table-lab-td">
                                    <span class="contact-info-title">Status regarding accreditation and
                                        certification:</span>
                                </td>
                                <td class="table-lab-td">Not accredited</td>
                            </tr>
                            <tr>
                                <td class="table-lab-td">
                                    <span class="contact-info-title">Sample testing capability according to test parameter
                                        method and equipment:</span>
                                </td>
                                <td class="table-lab-td">
                                    Service provided according to the requirement of the
                                    clients.
                                </td>
                            </tr>
                            <tr>
                                <td class="table-lab-td">
                                    <span class="contact-info-title">Biosafety & biosecurity measures:</span>
                                </td>
                                <td class="table-lab-td">
                                    Appropriate measures are taken for the respective method and
                                    services.
                                </td>
                            </tr>
                            <tr>
                                <td class="table-lab-td">
                                    <span class="contact-info-title">Waste management system:</span>
                                </td>
                                <td class="table-lab-td">
                                    Appropriate waste management measures for hazardous
                                    materials are taken according to the SOP and the Department
                                    of Environment (DoE), Bangladesh.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- lab-details end -->
        </div>

        <hr class="divider-footer" />
    </main>
@endsection

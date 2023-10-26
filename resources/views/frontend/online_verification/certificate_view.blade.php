<div class="certificates-container">
    <div id="certificateContent" class="certificates-content">
        <div class="certificate-header">
            <div class="certificate-logo">
                <img src="{{ asset('/') }}backend/asset/logo/govt-logo.png" alt="" />
            </div>
            <div class="certificate-header-content">
                <h4>Government of the People’s Republic of Bangladesh</h4>
                <h5>Bangladesh Food Safety Authority</h5>
                <p>
                    BSL Office Complex, Bhaban 2, (Level 4,5,6),119, Kazi Nazrul
                    Islam Avenue, Dhaka 1000
                </p>
            </div>
            <div class="certificate-logo">
                <img src="{{ asset('/') }}backend/asset/logo/bfsa-certifices.png" alt="" />
            </div>
        </div>
        <div>
            <h6 class="certificate-title">Health Certificate</h6>
        </div>

        <div class="ref-date">
            <p>Ref no: <span>
                {{ @$application->certificate_ref_no ?? 'N/A' }}
            </span></p>
            <p>Issue date: <span>{{date('d/m/Y',strtotime(@$application->issued_date)) ?? 'N/A'}}</span></p>
        </div>

        <div class="">
            <!-- table-1 -->
            <table class="customers">
                <tr>
                    <td class="table-td">
                        <span>01.</span>
                    </td>
                    <td class="table-td">
                        <span>Name,Address Email & National ID of the Exporter</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <div>
                            <p class="certificates-titles">{{ @$application->customerDetail->company_name }}</p>
                            <address>
                                ADDRESS:
                                <span>{{ @$application->exporter_address }}</span>
                            </address>
                            <p>{{ @$application->customer->email }}</p>
                            <p>{{ @$application->customer->customerDetail->nid_no }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">
                        <span>02.</span>
                    </td>
                    <td class="table-td">
                        <span>Name & Address of the Importer</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <div>
                            <p class="certificates-titles">
                                {{ @$application->buyer_name }}
                            </p>
                            <address>
                                ADDRESS:
                                <span>{{ @$application->buyer_address }}, {{ @$application->buyer_country }}</span>
                            </address>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">
                        <span>03.</span>
                    </td>
                    <td class="table-td">
                        <span>Product Name</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->product_name ?? 'N/A' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">
                        <span>04.</span>
                    </td>
                    <td class="table-td">
                        <span>Importing Country</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->importingCountry->name }}</span>
                    </td>
                </tr>

                <tr>
                    <td class="table-td">
                        <span>06.</span>
                    </td>
                    <td class="table-td">
                        <span>Port of Loading</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->port_loading }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">
                        <span>07.</span>
                    </td>
                    <td class="table-td">
                        <span>Port of discharge</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->port_discharge }}</span>
                    </td>
                </tr>

                <tr>
                    <td class="table-td">
                        <span>08.</span>
                    </td>
                    <td class="table-td">
                        <span>Mode of transport</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>
                            {{ @$application->mode_of_transport ? 'By ' . $application->modeOfTransport->name : 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">
                        <span>09.</span>
                    </td>
                    <td class="table-td">
                        <span>Reference No. of the test report</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <div>
                            <p class="certificates-titles">
                                {{ @$application->reference_no ?? 'N/A'}}
                            </p>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="table-td">
                        <span>10.</span>
                    </td>
                    <td class="table-td">
                        <span>Test report issue by</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{@$application->issuedBy->name ?? 'N/A' }}</span>
                    </td>
                </tr>

                <tr>
                    <td class="table-td">
                        <span>11.</span>
                    </td>
                    <td class="table-td">
                        <span>Details identifying the products</span>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span></span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> A. </span>
                            <span> Goods produces in (Country)</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->manufacturerCountry->name ?? 'N/A' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> B. </span>
                            <span>Type of Goods</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->typeGood->name ?? 'N/A' }}</span>
                    </td>
                </tr>

                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> C. </span>
                            <span>Description</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span class="certificates-titles">{{ @$application->description_goods ?? 'N/A' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> D. </span>
                            <span>Quantity</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->quantity ?? 'N/A' }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> E. </span>
                            <span>Type & Number of packs</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <span>{{ @$application->no_packing }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> F. </span><span>Net & Gross weight or other</span>
                        </p>
                        <p>quantity</p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles">NET WEIGHT:</span>
                            <span>{{ @$application->net_weight }}</span>
                        </p>
                        <p>
                            <span class="certificates-titles">WEIGHT:</span>
                            <span>{{ @$application->weight }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> G.</span>
                            <span>Temperature required during storage and
                                transport</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span
                                class="certificates-titles">{{ @$application->temperature ?? 'NOT APPLICABLE' }}</span>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> H.</span>
                            <span>Manufacturing date</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span>{{ @$application->manufacturing_date ?? 'N/A' }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> I.</span>
                            <span>Expiry date</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span>{{ @$application->expired_date ?? 'N/A' }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> J.</span>
                            <span>Invoice no/Batch no/Lot no & date</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span> INVOICE NO:</span>
                            <span> {{ @$application->invoice_no ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <span>{{ @$application->lc_no ?? 'N/A' }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> K.</span>
                            <span>Invoice Value FOB/CNF</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            BDT
                            <span> {{ @$application->fob_cfr_value ?? 'N/A' }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td"></td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles"> L.</span>
                            <span>LC/Contract details</span>
                        </p>
                    </td>
                    <td class="table-td">:</td>
                    <td class="table-td">
                        <p>
                            <span class="certificates-titles">SALES CONTRACT NO:</span>
                            <span>{{ @$application->lc_no ?? 'N/A' }}</span>
                        </p>
                        <p>
                            <span class="certificates-titles">DATED:</span>
                            <span> {{ @$application->lc_date ?? 'N/A' }}</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="table-td">12.</td>
                    <td class="table-td" colspan="3">
                        <p>
                            It is hereby certified that the product describe above
                            has been processed as per the Buyer’s
                            requirement/specification of the importing
                            country/national standards. It was stored and
                            transported under hygienic conditions. The product of
                            the export consignment is fit for human consumption.
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="cerficate-footer">
            <div class="footer-content">
                <div class="left-footer-content">
                    <p class="footer-text">
                        Place of issue: <span>DHAKA, BANGLADESH</span>
                    </p>
                    <p class="footer-text">
                        Date of issue: <span>{{date('d/m/Y',strtotime(@$application->issued_date)) ?? 'N/A'}}</span>
                    </p>
                </div>
                <div class="right-footer-content">
                    <div class="signature-img">
                        <p class="footer-text">
                            Signature of authorized officer:
                        </p>
                        <img class="signature-image" src="{{@$applicationStep->createdBy->signature ? asset('upload/signature/'.@$applicationStep->createdBy->signature) : '' }}"
                            alt="" />
                    </div>
                    <p class="footer-text">
                        Name: <span>Sourav Kumar Singha</span>
                    </p>
                    <p class="footer-text">
                        Designation:
                        <span>Scientific Officer, Certification Section</span>
                    </p>
                    <div class="signature-img">
                        <p class="footer-text">Seal:</p>
                        <img class="signature-image1" src="{{ @$applicationStep->createdBy->seal ?  asset('upload/seal/'.@$applicationStep->createdBy->seal) : '' }}"
                            alt="" />
                    </div>
                </div>
            </div>

            <div class="barCode-container">
                <p>
                    This certificate has been issued on the request of the above
                    mentioned exporter
                </p>
                <div class="barCode-img mt-2">
                    {!! QrCode::size(100)->generate($text) !!}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="btn-print">
        <button onclick="printDiv('certificateContent')" class="btn btn-continue">Print</button>
    </div> --}}
</div>

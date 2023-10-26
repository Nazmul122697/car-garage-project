<!--profile  Modal -->
<div class="modal fade" id="profileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-6 dashboard-title" id="profileModalLabel">
                    Complete Your Profile
                </h2>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>

            <form id="customerDetailsForm" action="{{ route('customer.details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body" style="padding: 20px 50px">
                    <!--  -->
                    <div>
                        <div class="row g-3">
                            <!-- Company name -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="company_name" class="mb-2">Company Name</label>
                                <input type="text" name="company_name" id="company_name"
                                    value="{{old('company_name')}}" placeholder="Enter your company name"
                                    class="form-control input-style py-2 small-text-12 @error('company_name') is-invalid @enderror" required/>
                                @error('company_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!--Nature of Company -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="nature" class="mb-2">Nature of company</label>
                                <select name="nature" id="nature" class="form-select input-style  py-2 small-text-12 @error('nature') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select...</option>
                                    @foreach ( $natures as $nature)
                                    <option value="{{$nature->id}}" {{old('nature') == $nature->id ? 'selected' : ''}}>{{$nature->name}}</option>
                                    @endforeach
                                </select>

                                @error('nature')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!-- nid no -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="nid_no" class="mb-2">NID NO.</label>
                                <input type="number" name="nid_no" id="nid_no"
                                    value="{{old('nid_no')}}"
                                    placeholder="Enter nid no."
                                    class="form-control input-style py-2 small-text-12 @error('nid_no') is-invalid @enderror"/>
                                @error('nid_no')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!-- upload nid-->
                            <div class="col-12 col-md-6 login-field">
                                <label class="mb-2">Upload NID</label>
                                <input type="file" name="nid_file" id="nid_file"
                                    class="form-control input-style py-2 small-text-12 @error('nid_file') is-invalid @enderror" accept="application/pdf" required/>
                                @error('nid_file')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!-- erc no-->
                            <div class="col-12 col-md-6 login-field">
                                <label for="erc_no" class="mb-2">ERC NO.</label>
                                <input type="number" name="erc_no" id="erc_no" value="{{old('erc_no')}}" placeholder="Enter ERC no."
                                    class="form-control input-style py-2 small-text-12 @error('erc_no') is-invalid @enderror" maxlength="16" required/>
                                @error('erc_no')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!--erc/irc expiry date -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="erc_expiry_date" class="mb-2">ERC Expiry Date</label>
                                <input type="date" name="erc_expiry_date" id="erc_expiry_date"
                                    placeholder="Enter expiry date"
                                    value="{{old('erc_expiry_date')}}"
                                    min="{{date("Y-m-d")}}"
                                    class="form-control input-style py-2 small-text-12 @error('erc_expiry_date') is-invalid @enderror" required/>
                                @error('erc_expiry_date')
                                    <span class="text-danger"></span>
                                @enderror
                            </div>

                            <!-- upload erc/irc-->
                            <div class="col-12 col-md-6 col-lg-12 login-field">
                                <label class="mb-2">Upload ERC</label>
                                <input type="file" id="erc_file"
                                    name="erc_file" class="form-control input-style small-text-12 @error('erc_file') is-invalid @enderror"
                                    accept="application/pdf" required/>
                                @error('erc_file')
                                    <span class="text-danger"></span>
                                @enderror
                            </div>

                            <!-- bin no -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="bin_no" class="mb-2">BIN NO.</label>
                                <input type="number" name="bin_no" id="bin_no" value="{{old('bin_no')}}" placeholder="Enter bin no."
                                    class="form-control input-style py-2 small-text-12 @error('bin_no') is-invalid @enderror" />
                                @error('bin_no')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- bin expiry date -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="bin_expiry_date" class="mb-2">BIN Expiry Date</label>
                                <input type="date" name="bin_expiry_date" id="bin_expiry_date"
                                    placeholder="Enter expiry date"
                                    value="{{old('bin_expiry_date')}}"
                                    min="{{date("Y-m-d")}}"
                                    class="form-control input-style py-2 small-text-12 @error('bin_expiry_date') is-invalid @enderror" required/>
                                @error('bin_expiry_date')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- upload bin-->
                            <div class="col-12 col-md-6 col-lg-12 login-field">
                                <label for="bin_file" class="mb-2">Upload BIN</label>
                                <input type="file" id="bin_file"
                                    name="bin_file" class="form-control input-style small-text-12 @error('bin_file') is-invalid @enderror"
                                    accept="application/pdf" required/>
                                @error('bin_file')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <!-- tin no -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="tin_no" class="mb-2">TIN NO.</label>
                                <input type="number" name="tin_no" id="tin_no" value="{{old('tin_no')}}" placeholder="Enter tin no."
                                    class="form-control input-style py-2 small-text-12 @error('tin_no') is-invalid @enderror" required/>
                                @error('tin_no')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- tin expiry date -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="tin_expiry_date" class="mb-2">TIN Expiry Date</label>
                                <input type="date" name="tin_expiry_date" id="tin_expiry_date"
                                    placeholder="Enter expiry date"
                                    value="{{old('tin_expiry_date')}}"
                                    min="{{date("Y-m-d")}}"
                                    class="form-control input-style py-2 small-text-12 @error('tin_expiry_date') is-invalid @enderror" required/>
                                @error('tin_expiry_date')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- upload tin-->
                            <div class="col-12 col-md-6 col-lg-12 login-field">
                                <label for="tin_file" class="mb-2">Upload TIN</label>
                                <input type="file" id="tin_file"
                                    name="tin_file" class="form-control input-style small-text-12 @error('tin_file') is-invalid @enderror"
                                    accept="application/pdf" required/>
                                @error('tin_file')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <!-- trade no -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="trade_no" class="mb-2">Trade Licence NO.</label>
                                <input type="number" name="trade_no" id="trade_no" value="{{old('trade_no')}}" placeholder="Enter trade no."
                                    class="form-control input-style py-2 small-text-12 @error('trade_no') is-invalid @enderror" required/>
                                @error('trade_no')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- trade expiry date -->
                            <div class="col-12 col-md-6 login-field">
                                <label for="trade_expiry_date" class="mb-2">Trade Licence Expiry Date</label>
                                <input type="date" name="trade_expiry_date" id="trade_expiry_date"
                                    placeholder="Enter expiry date"
                                    value="{{old('trade_expiry_date')}}"
                                    min="{{date("Y-m-d")}}"
                                    class="form-control input-style py-2 small-text-12 @error('trade_expiry_date') is-invalid @enderror" required/>
                                @error('trade_expiry_date')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <!-- upload trade-->
                            <div class="col-12 col-md-6 col-lg-12 login-field">
                                <label for="trade_file" class="mb-2">Upload Trade Licence</label>
                                <input type="file" id="trade_file"
                                        name="trade_file" class="form-control input-style small-text-12 @error('trade_file') is-invalid @enderror"
                                        accept="application/pdf" required/>
                                @error('trade_file')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
                <div class="modal-footer" style="border-top: 0; padding: 0px 50px 20px">
                    <button type="submit" class="btn btn-primary"
                        style="background: #002148; border: 1px solid #002148">
                        Complete Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

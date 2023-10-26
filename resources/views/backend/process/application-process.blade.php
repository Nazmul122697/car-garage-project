@extends('backend.master')

@push('css')
    <style>
        .custom_select {
            width: 50%;
            padding: 5px;
            border: 1px solid #1e2772;
            border-radius: 30px;
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">

        @php
            $authUser = Auth::user();
        @endphp
        <div class="shadow rounded-4 user-table" style="{{ Auth::user()->role_id == 5 ? 'margin: 0px !important;' : '' }}">
            <div class="table-responsive">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th scope="col" class="table-text">Step</th>
                            <th scope="col" class="table-text">User</th>
                            <th scope="col" class="table-text">Remark</th>
                            <th scope="col" class="table-text">Assign to</th>
                            <th scope="col" class="table-text">Forward</th>
                            <th scope="col" class="table-text text-center">Uploaded Doc</th>
                            <th scope="col" class="table-text">Action Date</th>
                            <th scope="col" class="table-text text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- PROCESS (1) START HERE (FA) --}}
                        @if ($application->application_status != 6) {{-- Application On hold check --}}
                            <tr class="text-wrap">
                                <td class="table-text">1</td>
                                <td class="table-text">FA <br>
                                    {{ !empty($faFirstProcess) ? $faFirstProcess->createdBy->name : '' }}
                                </td>
                                <td class="table-text">
                                    @if (!empty($faFirstProcess))
                                        <button class="btn btn-application py-1 px-2 viewRemark"
                                            data-url="{{ route('view.remark', $faFirstProcess->id) }}">
                                            <i class="fa-regular fa-eye puls-app"></i>
                                            view
                                        </button>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{ !empty($faFirstProcess) ? ($faFirstProcess->created_by ? $faFirstProcess->assignUser->name . ' ' . '(FSO)' : 'N/A') : 'N/A' }}
                                    <br>
                                    <span>{{ !empty($faFirstProcess) ? ($faFirstProcess->lab_user_id ? $faFirstProcess->labUser->name . ' ' . '(Lab)' : '') : '' }}</span>
                                </td>
                                <td class="table-text">
                                    {{ !empty($faFirstProcess) ? ($faFirstProcess->forward_user_id ? $faFirstProcess->forwardUser->name : 'N/A') : 'N/A' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (!empty($faFirstProcess))
                                        {{-- File Show Strart --}}
                                        @php
                                            $all_docs = json_decode($faFirstProcess->doc_file);
                                        @endphp

                                        @if (!empty($all_docs))
                                            @foreach ($all_docs as $single_doc)
                                                <a href="{{ asset('upload/process/' . $single_doc) }}" class="link_btn"
                                                    target="__blank">{{ $single_doc }}</a> <br>
                                            @endforeach
                                        @else
                                            <span>N/A</span>
                                        @endif
                                        {{-- File Show End --}}
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{ !empty($faFirstProcess) ? ($faFirstProcess->created_at ? date('d-m-Y', strtotime($faFirstProcess->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($faFirstProcess) ? ($faFirstProcess->created_at ? $faFirstProcess->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (empty($faFirstProcess))
                                        @if ($authUser->role_id == 3)
                                            {{-- Role check --}}
                                            <a href="#" class="btn-global proceed-btn" data-bs-toggle="modal"
                                                data-bs-target="#faProcessModal">Proceed</a>
                                            <a href="#" class="btn-global hold-btn" data-bs-toggle="modal"
                                                data-bs-target="#onholdModal">On Hold</a>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        <span class="badge bg-success">Proceeded</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (1) END HERE (FA) --}}


                        {{-- PROCESS (2) START HERE (FSO) --}}
                        @if (!empty($faFirstProcess))
                            <tr>
                                <td class="table-text">2</td>
                                <td class="table-text">FSO<br>
                                    {{ !empty($rfsoProcess) ? $rfsoProcess->createdBy->name : '' }}</td>
                                <td class="table-text">
                                    @if (!empty($rfsoProcess))
                                        <button class="btn btn-application py-1 px-2 viewRemark"
                                            data-url="{{ route('view.remark', $rfsoProcess->id) }}">
                                            <i class="fa-regular fa-eye puls-app"></i>
                                            view
                                        </button>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{-- {{ !empty($rfsoProcess) ? ($rfsoProcess->created_by ? $rfsoProcess->assignUser->name : 'N/A') : 'N/A' }} --}}
                                </td>
                                <td class="table-text">
                                    {{ !empty($rfsoProcess) ? ($rfsoProcess->forward_user_id ? $rfsoProcess->forwardUser->name : 'N/A') : 'N/A' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (!empty($rfsoProcess))
                                        {{-- File Show Strart --}}
                                        @php
                                            $all_docs2 = json_decode($rfsoProcess->doc_file);
                                        @endphp

                                        @if (!empty($all_docs2))
                                            @foreach ($all_docs2 as $single_doc)
                                                <a href="{{ asset('upload/process/' . $single_doc) }}" class="link_btn"
                                                    target="__blank">{{ $single_doc }}</a> <br>
                                            @endforeach
                                        @else
                                            <span>N/A</span>
                                        @endif
                                        {{-- File Show End --}}
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{ !empty($rfsoProcess) ? ($rfsoProcess->created_at ? date('d-m-Y', strtotime($rfsoProcess->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($rfsoProcess) ? ($rfsoProcess->created_at ? $rfsoProcess->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (empty($rfsoProcess))
                                        @if ($authUser->role_id == 4 && $authUser->id == $faFirstProcess->assign_user_id)
                                            {{-- Role check --}}
                                            <a href="#" class="btn-global proceed-btn" data-bs-toggle="modal"
                                                data-bs-target="#proceedRfsoModal">Proceed</a>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        @if ($authUser->role_id == 4 && $authUser->id == $faFirstProcess->assign_user_id && $faFirstProcess->isResampling == 1)
                                            {{-- Role check --}}
                                            <a href="#" class="btn-global" data-bs-toggle="modal"
                                                data-bs-target="#proceedRfsoModal"
                                                style="background-color: #f6b000;">Proceed
                                                Resampling</a>
                                        @elseif ($faFirstProcess->isResampling == 1)
                                            <span class="badge" style="background-color: #f6b000;">Proceed
                                                Resampling</span>
                                        @else
                                            <span class="badge bg-success">Proceeded</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (2) END HERE (FSO) --}}


                        {{-- PROCESS (3) START HERE (LAB) --}}
                        @if (!empty($rfsoProcess))
                            <tr>
                                <td class="table-text">3</td>
                                <td class="table-text">LAB<br>
                                    {{ !empty($labProcess) ? $labProcess->createdBy->name : '' }}</td>
                                <td class="table-text">
                                    @if (!empty($labProcess))
                                        <button class="btn btn-application py-1 px-2 viewRemark"
                                            data-url="{{ route('view.remark', $labProcess->id) }}">
                                            <i class="fa-regular fa-eye puls-app"></i>
                                            view
                                        </button>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text"></td>
                                <td class="table-text"></td>
                                <td class="table-text text-center">
                                    @if (!empty($labProcess))
                                        {{-- File Show Strart --}}
                                        @php
                                            $all_docs3 = json_decode($labProcess->doc_file);
                                        @endphp

                                        @if (!empty($all_docs3))
                                            @foreach ($all_docs3 as $single_doc)
                                                <a href="{{ asset('upload/process/' . $single_doc) }}" class="link_btn"
                                                    target="__blank">{{ $single_doc }}</a> <br>
                                            @endforeach
                                        @else
                                            <span>N/A</span>
                                        @endif
                                        {{-- File Show End --}}
                                        {{-- <a href="{{ asset('upload/process/' . $labProcess->doc_file) }}" class="link_btn"
                                            target="__blank">{{ $labProcess->doc_file }}</a> --}}
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{ !empty($labProcess) ? ($labProcess->created_at ? date('d-m-Y', strtotime($labProcess->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($labProcess) ? ($labProcess->created_at ? $labProcess->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (empty($labProcess))
                                        @if ($authUser->role_id == 5 && $authUser->id == $faFirstProcess->lab_user_id)
                                            {{-- Role check --}}
                                            @if ($application->sample_collect == '')
                                                {{-- Sample collect check --}}
                                                <form action="{{ route('received.sample') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="application_id"
                                                        value="{{ $application->id }}">
                                                    <button type="submit" class="btn-global"
                                                        style="background-color: mediumslateblue">Received Sample</button>
                                                </form>
                                            @else
                                                <a href="#" class="btn-global proceed-btn" data-bs-toggle="modal"
                                                    data-bs-target="#proceedLabModal">Proceed</a>
                                                <a href="#" class="btn-global resampling-btn" data-bs-toggle="modal"
                                                    data-bs-target="#labResamplingModal">Resampling</a>
                                            @endif
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        @if (
                                            $authUser->role_id == 5 &&
                                                $authUser->id == $faFirstProcess->lab_user_id &&
                                                $labProcess->isResampling == 1 &&
                                                $labProcess->helper_status == 1)
                                            {{-- Role check --}}
                                            <a href="#" class="btn-global" data-bs-toggle="modal"
                                                data-bs-target="#proceedLabModal"
                                                style="background-color: #f6b000;">Proceed
                                                Resampling</a>
                                        @elseif ($labProcess->isResampling == 1)
                                            <span class="badge" style="background-color: #f6b000;">Proceed
                                                Resampling</span>
                                        @else
                                            <span class="badge bg-success">Proceeded</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (3) END HERE (LAB) --}}


                        {{-- PROCESS (4) START HERE (FA 2) --}}
                        @if (!empty($labProcess))
                            <tr>
                                <td class="table-text">4</td>
                                <td class="table-text">FA<br>
                                    {{ !empty($fa2Process) ? $fa2Process->createdBy->name : '' }}</td>
                                <td class="table-text">
                                    @if (!empty($fa2Process))
                                        @if ($fa2Process->remark != '')
                                            <button class="btn btn-application py-1 px-2 viewRemark"
                                                data-url="{{ route('view.remark', $fa2Process->id) }}">
                                                <i class="fa-regular fa-eye puls-app"></i>
                                                view
                                            </button>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="table-text"></td>
                                <td class="table-text">
                                    {{ !empty($fa2Process) ? ($fa2Process->forward_user_id ? $fa2Process->forwardUser->name : 'N/A') : 'N/A' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (!empty($fa2Process))

                                        {{-- File Show Strart --}}
                                        @php
                                            $all_docs4 = json_decode($fa2Process->doc_file);
                                        @endphp

                                        @if (!empty($all_docs4))
                                            @foreach ($all_docs4 as $single_doc)
                                                <a href="{{ asset('upload/process/' . $single_doc) }}" class="link_btn"
                                                    target="__blank">{{ $single_doc }}</a> <br>
                                            @endforeach
                                        @else
                                            <span>N/A</span>
                                        @endif
                                        {{-- File Show End --}}
                                        {{-- <a href="{{ asset('upload/process/' . $fa2Process->doc_file) }}" class="link_btn"
                                            target="__blank">{{ $fa2Process->doc_file }}</a> --}}
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </td>
                                <td class="table-text">
                                    {{ !empty($fa2Process) ? ($fa2Process->created_at ? date('d-m-Y', strtotime($fa2Process->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($fa2Process) ? ($fa2Process->created_at ? $fa2Process->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (empty($fa2Process))
                                        @if ($authUser->role_id == 3 && $authUser->id == $faFirstProcess->created_by)
                                            {{-- Role check & First Creadted by FA check --}}
                                            @if ($labProcess->isResampling != 1)
                                                <a href="#" class="btn-global proceed-btn" data-bs-toggle="modal"
                                                    data-bs-target="#proceedFa2Modal">Proceed</a>
                                            @elseif ($labProcess->isResampling == 1)
                                                <a href="#" class="btn-global resampling-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#faResamplingModal">Resampling</a>
                                            @endif
                                            <a href="#" class="btn-global reject-btn"
                                                onclick="rejectApplication('fa2')">Reject</a>
                                            <a href="#" class="btn-global forward-btn" data-bs-toggle="modal"
                                                data-bs-target="#forwardFAModal">Forward</a>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        @if (!empty($fa2Process) && $fa2Process->remark == null)
                                            @if ($authUser->role_id == 3 && $authUser->id == $fa2Process->forward_user_id)
                                                {{-- Role check & Forward User check --}}
                                                @if ($labProcess->isResampling != 1)
                                                    <a href="#" class="btn-global proceed-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#proceedFa2Modal">Proceed</a>
                                                @elseif ($labProcess->isResampling == 1)
                                                    <a href="#" class="btn-global resampling-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#faResamplingModal">Resampling</a>
                                                @endif
                                                <a href="#" class="btn-global reject-btn"
                                                    onclick="rejectApplication('fa2')">Reject</a>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        @else
                                            @if ($fa2Process->isRejected == 1)
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif ($fa2Process->isResampling == 1)
                                                @if (
                                                    $authUser->role_id == 3 &&
                                                        $authUser->id == $faFirstProcess->created_by &&
                                                        $fa2Process->forward_user_id == null &&
                                                        $fa2Process->helper_status == 1)
                                                    {{-- if data is resampling --}}
                                                    <a href="#" class="btn-global proceed-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#proceedFa2Modal">Proceed</a>
                                                @elseif ($authUser->role_id == 3 && $authUser->id == $fa2Process->forward_user_id && $fa2Process->helper_status == 1)
                                                    <a href="#" class="btn-global proceed-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#proceedFa2Modal">Proceed</a>
                                                @else
                                                    <span class="badge"
                                                        style="background-color: #f6b000;">Resampling</span>
                                                @endif
                                            @else
                                                <span class="badge bg-success">Proceeded</span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (4) END HERE (FA 2) --}}


                        {{-- PROCESS (5) START HERE (SO 1) --}}
                        @if (!empty($fa2Process))
                            @if ($fa2Process->isRejected != 1 && $fa2Process->isResampling != 1 && $fa2Process->remark != '')
                                <tr>
                                    <td class="table-text">5</td>
                                    <td class="table-text">SO<br>
                                        {{ !empty($so1Process) ? $so1Process->createdBy->name : '' }}</td>
                                    <td class="table-text">
                                        @if (!empty($so1Process))
                                            <button class="btn btn-application py-1 px-2 viewRemark"
                                                data-url="{{ route('view.remark', $so1Process->id) }}">
                                                <i class="fa-regular fa-eye puls-app"></i>
                                                view
                                            </button>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td class="table-text"></td>
                                    <td class="table-text"></td>
                                    <td class="table-text text-center"></td>
                                    <td class="table-text">
                                        {{ !empty($so1Process) ? ($so1Process->created_at ? date('d-m-Y', strtotime($so1Process->created_at)) : 'N/A') : 'N/A' }}
                                        <br>
                                        {{ !empty($so1Process) ? ($so1Process->created_at ? $so1Process->created_at->diffForHumans() : 'N/A') : '' }}
                                    </td>
                                    <td class="table-text text-center">
                                        @if (empty($so1Process))
                                            @if ($authUser->role_id == 6)
                                                {{-- Role check --}}
                                                <a href="#" class="btn-global proceed-btn"
                                                    onclick="proceed('SO')">Approve</a>
                                                <a href="#" class="btn-global reject-btn"
                                                    onclick="rejectApplication('so1')">Reject</a>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        @else
                                            @if ($so1Process->isRejected == 1)
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-success">Proceeded</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endif
                        {{-- PROCESS (5) END HERE (SO 1) --}}

                        {{-- PROCESS (6) START HERE (DIRECTOR 1) --}}
                        @if (!empty($so1Process))
                            @if ($so1Process->isRejected != 1)
                                <tr>
                                    <td class="table-text">6</td>
                                    <td class="table-text">Director<br>
                                        {{ !empty($director1Process) ? $director1Process->createdBy->name : '' }}</td>
                                    <td class="table-text">
                                        @if (!empty($director1Process))
                                            <button class="btn btn-application py-1 px-2 viewRemark"
                                                data-url="{{ route('view.remark', $director1Process->id) }}">
                                                <i class="fa-regular fa-eye puls-app"></i>
                                                view
                                            </button>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td class="table-text"></td>
                                    <td class="table-text"></td>
                                    <td class="table-text text-center"></td>
                                    <td class="table-text">
                                        {{ !empty($director1Process) ? ($director1Process->created_at ? date('d-m-Y', strtotime($director1Process->created_at)) : 'N/A') : 'N/A' }}
                                        <br>
                                        {{ !empty($director1Process) ? ($director1Process->created_at ? $director1Process->created_at->diffForHumans() : 'N/A') : '' }}
                                    </td>
                                    <td class="table-text text-center">
                                        @if (empty($director1Process))
                                            @if ($authUser->role_id == 7)
                                                {{-- Role check --}}
                                                <a href="#" class="btn-global proceed-btn"
                                                    onclick="proceed('director1')">Approve</a>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        @else
                                            <span class="badge bg-success">Proceeded</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endif
                        {{-- PROCESS (6) END HERE (DIRECTOR 1) --}}

                        {{-- PROCESS (7) START HERE (MEMBER 1) --}}
                        @if (!empty($director1Process))
                            <tr>
                                <td class="table-text">7</td>
                                <td class="table-text">Member<br>
                                    {{ !empty($member1Process) ? $member1Process->createdBy->name : '' }}</td>
                                <td class="table-text">
                                    @if (!empty($member1Process))
                                        @if ($member1Process->remark != '')
                                            <button class="btn btn-application py-1 px-2 viewRemark"
                                                data-url="{{ route('view.remark', $member1Process->id) }}">
                                                <i class="fa-regular fa-eye puls-app"></i>
                                                view
                                            </button>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="table-text"></td>
                                <td class="table-text"></td>
                                <td class="table-text text-center"></td>
                                <td class="table-text">
                                    {{ !empty($member1Process) ? ($member1Process->created_at ? date('d-m-Y', strtotime($member1Process->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($member1Process) ? ($member1Process->created_at ? $member1Process->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">
                                    @if (empty($member1Process))
                                        @if ($authUser->role_id == 8)
                                            {{-- Role check --}}
                                            {{-- <div class="d-flex align-items-center gap-1"> --}}
                                                <a href="#" class="btn-global proceed-btn"
                                                    onclick="proceed('member1')">Approve</a>

                                                {{-- <form action="{{ route('member.process.skip') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="application_id"
                                                        value="{{ $application->id }}">
                                                    <button type="submit" class="btn-global"
                                                        style="background-color: orangered;">Skip</button>
                                                </form> --}}
                                            {{-- </div> --}}
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        @if ($member1Process->isSkipped == 1)
                                            <span class="badge" style="background-color: orangered;">Skipped</span>
                                        @else
                                            <span class="badge bg-success">Proceeded</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (7) END HERE (MEMBER 1) --}}

                        {{-- PROCESS (8) START HERE (DIRECTOR 2) --}}
                        @if (!empty($member1Process))
                            <tr>
                                <td class="table-text">8</td>
                                <td class="table-text">Director<br>
                                    {{ !empty($director2Process) ? $director2Process->createdBy->name : '' }}</td>
                                <td class="table-text">
                                    @if (!empty($director2Process))
                                        @if ($director2Process->remark != '')
                                            <button class="btn btn-application py-1 px-2 viewRemark"
                                                data-url="{{ route('view.remark', $director2Process->id) }}">
                                                <i class="fa-regular fa-eye puls-app"></i>
                                                view
                                            </button>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="table-text"></td>
                                <td class="table-text">
                                    {{ !empty($director2Process) ? ($director2Process->forward_user_id ? $director2Process->forwardUser->name : 'N/A') : 'N/A' }}
                                </td>
                                <td class="table-text text-center"></td>
                                <td class="table-text">
                                    {{ !empty($director2Process) ? ($director2Process->created_at ? date('d-m-Y', strtotime($director2Process->created_at)) : 'N/A') : 'N/A' }}
                                    <br>
                                    {{ !empty($director2Process) ? ($director2Process->created_at ? $director2Process->created_at->diffForHumans() : 'N/A') : '' }}
                                </td>
                                <td class="table-text text-center">

                                    @if (empty($director2Process))
                                        @if ($authUser->role_id == 7 && $authUser->id == $director1Process->created_by)
                                            {{-- Role check --}}
                                            {{-- <div class="d-flex align-items-center gap-1"> --}}
                                                <a href="#" class="btn-global proceed-btn"
                                                    onclick="proceed('director2')">Approve</a>
                                                <a href="#" class="btn-global forward-btn" data-bs-toggle="modal"
                                                    data-bs-target="#forwardDirectorModal">Forward</a>

                                                {{-- <form action="{{ route('director.process.skip') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="application_id"
                                                        value="{{ $application->id }}">
                                                    <button type="submit" class="btn-global"
                                                        style="background-color: orangered;">Skip</button>
                                                </form> --}}
                                            {{-- </div> --}}
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    @else
                                        @if (!empty($director2Process) && $director2Process->remark == null)
                                            @if ($authUser->role_id == 7 && $authUser->id == $director2Process->forward_user_id && $director2Process->isSkipped != 1)
                                                {{-- Role check & Forward User check --}}
                                                {{-- <div class="d-flex align-items-center gap-1"> --}}
                                                    <a href="#" class="btn-global proceed-btn"
                                                        onclick="proceed('director2')">Approve</a>

                                                    {{-- <form action="{{ route('director.process.skip') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" name="application_id"
                                                            value="{{ $application->id }}">
                                                        <button type="submit" class="btn-global"
                                                            style="background-color: orangered;">Skip</button>
                                                    </form> --}}
                                                {{-- </div> --}}
                                            @else
                                                {{-- <span>N/A  pppppp</span> --}}
                                                @if ($director2Process->isSkipped == 1)
                                                    <span class="badge"
                                                        style="background-color: orangered;">Skipped</span>
                                                @elseif ($director2Process->remark == null)
                                                    <span>N/A</span>
                                                @endif
                                            @endif
                                        @else
                                            <span class="badge bg-success">Proceeded</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endif
                        {{-- PROCESS (8) END HERE (DIRECTOR 2) --}}


                        {{-- PROCESS (9) START HERE (SO 2) --}}
                        @if (!empty($director2Process))
                            @if ($director2Process->remark != '' || $director2Process->isSkipped == 1)
                                <tr>
                                    <td class="table-text">9</td>
                                    <td class="table-text">SO<br>
                                        {{ !empty($finalProcess) ? $finalProcess->createdBy->name : '' }}</td>
                                    <td class="table-text"></td>
                                    <td class="table-text"></td>
                                    <td class="table-text">
                                        {{ !empty($finalProcess) ? ($finalProcess->forward_user_id ? $finalProcess->forwardUser->name : 'N/A') : 'N/A' }}
                                    </td>
                                    <td class="table-text text-center"></td>
                                    <td class="table-text">
                                        {{ !empty($finalProcess) ? ($finalProcess->created_at ? date('d-m-Y', strtotime($finalProcess->created_at)) : 'N/A') : 'N/A' }}
                                        <br>
                                        {{ !empty($finalProcess) ? ($finalProcess->created_at ? $finalProcess->created_at->diffForHumans() : 'N/A') : '' }}
                                    </td>
                                    <td class="table-text text-center">
                                        @if (empty($finalProcess))
                                            @if ($authUser->role_id == 6 && $authUser->id == $so1Process->created_by)
                                                {{-- Role check --}}
                                                <a href="#" class="btn-global proceed-btn" data-bs-toggle="modal"
                                                    data-bs-target="#soProceedFinalModal">Approve</a>
                                                <a href="#" class="btn-global forward-btn" data-bs-toggle="modal"
                                                    data-bs-target="#forwardSOModal">Forward</a>
                                                <a href="#" class="btn-global reject-btn"
                                                    onclick="rejectApplication('finalReject')">Reject</a>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        @else
                                            @if (!empty($finalProcess) && $finalProcess->isFinalized == 0)
                                                @if ($authUser->role_id == 6 && $authUser->id == $finalProcess->forward_user_id && $finalProcess->isRejected != 1)
                                                    {{-- Role check & Forward User check --}}
                                                    <a href="#" class="btn-global proceed-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#soProceedFinalModal">Approve</a>
                                                    <a href="#" class="btn-global reject-btn"
                                                        onclick="rejectApplication('finalReject')">Reject</a>
                                                @else
                                                    @if ($finalProcess->isRejected == 1)
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                @endif
                                            @else
                                                @if (
                                                    $authUser->role_id == 6 &&
                                                        $finalProcess->forward_user_id != null &&
                                                        $authUser->id == $finalProcess->forward_user_id)
                                                    @if ($finalProcess->isFinalized == 1)
                                                        <a href="{{ route('certificate.view', $application->id) }}"
                                                            class="btn btn-sm text-light"
                                                            style="background-color: #30419b">Certificate</a>
                                                    @endif
                                                @elseif ($authUser->role_id == 6 && $finalProcess->forward_user_id == null && $authUser->id == $so1Process->created_by)
                                                    @if ($finalProcess->isFinalized == 1)
                                                        <a href="{{ route('certificate.view', $application->id) }}"
                                                            class="btn btn-sm text-light"
                                                            style="background-color: #30419b">Certificate</a>
                                                    @endif
                                                @else
                                                    @if ($finalProcess->isRejected != 1)
                                                        <span class="badge bg-info">Complete</span>
                                                    @endif
                                                    @if ($finalProcess->isRejected == 1)
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endif
                        {{-- PROCESS (9) END HERE (SO 2) --}}
                    </tbody>
                </table>
            </div>
        </div>


        @if (Auth::user()->role_id != 5)
            <div class="fa-details">
                <div class="fa-details-left shadow rounded-4">
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">1</div>
                            <h1 class="page-title">Exporter’s Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">ERC No.</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->erc_no ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Exporter’s Name</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->exporter_name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">National ID</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->customerDetail->nid_no ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Company Name</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->customerDetail->company_name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Exporter Address</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->exporter_address ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Exporter Address</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->customer->division ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Exporter Address</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->customer->district ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Invoice No.</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>#{{ $application->invoice_no ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Invoice Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>@formatdate($application->invoice_date)</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Contact/LC No.</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>#{{ $application->lc_no ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Contact/LC No. Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>@formatdate($application->lc_date)</span>
                            </p>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">2</div>
                            <h1 class="page-title">Manufacturer’s Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Manufacturers Name</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->manufacturer_name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Manufacturers Address</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->manufacturer_address ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Manufacturers Country</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->manufacturerCountry ? $application->manufacturerCountry->name : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">3</div>
                            <h1 class="page-title">Buyer’s Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Buyer’s Name</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->buyer_name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Buyer’s Address</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->buyer_address ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Buyer’s Email</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->buyer_email ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Buyer’s Country</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->buyerCountry ? $application->buyerCountry->name : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">4</div>
                            <h1 class="page-title">Product Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Product Name</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->product_name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Product expired date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>@formatdate($application->expired_date)</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Port of Loading</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->port_loading ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Port of Loading</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->port_loading ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Address of consignment to be stored</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->address_consignment ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Manufactureing Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>@formatdate($application->manufacturing_date)</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Probale date of loading</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>@formatdate($application->probable_date)</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Port of Discharge</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->port_discharge ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Country of consignment</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->consignmentCountry->name ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">5</div>
                            <h1 class="page-title">Shipping Information</h1>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Shipping Mark</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->shipping_mark ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">No. of Packing</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->no_packing ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Kind of Packing</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->kind_packing ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">HS Code</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->hs_code ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Type of Goods</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->typeGood->name ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Mode of transportation</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->mode_of_transport ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Description of Goods</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->description_goods ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Temperature during storage and transport</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->temperature ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Net and Gross or others Quantity</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->net_weight ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Quantity</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->quantity ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">FOB/CFR Value</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ $application->fob_cfr_value ? $application->fob_cfr_value . ' BDT' : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="fa-details-right shadow rounded-4">
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 title-2">
                            <div class="serial-number">1</div>
                            <h1 class="page-title">Uploaded Documents</h1>
                        </div>

                        <!--Trade License Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Trade License</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->customer->customerDetail->trade_file)
                                        <a href="{{ asset('upload/trade_license/' . $application->customer->customerDetail->trade_file) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->customer->customerDetail->trade_file }}</a>
                                    @else
                                        N/A
                                    @endif
                                    {{-- <a href="{{ asset('upload/process/'.$rfsoProcess->doc_file) }}" class="link_btn" target="__blank">{{ $rfsoProcess->doc_file }}</a> --}}
                                </span>
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Expire Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->customer->customerDetail->trade_expiry_date ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <hr class="hr-line" />
                        <!--Trade License End-->

                        <!-- Bin Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">BIN</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>
                                <span>
                                    @if ($application->customer->customerDetail->bin_file)
                                        <a href="{{ asset('upload/bin/' . $application->customer->customerDetail->bin_file) }}"
                                            class="text-decoration-underline"
                                            target="_blank">{{ @$application->customer->customerDetail->bin_file }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Expire Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->customer->customerDetail->bin_expiry_date ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <hr class="hr-line" />
                        <!-- Bin End-->

                        <!-- Tin Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">TIN</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>
                                <span>
                                    @if ($application->customer->customerDetail->tin_file)
                                        <a href="{{ asset('upload/tin/' . $application->customer->customerDetail->tin_file) }}"
                                            class="text-decoration-underline"
                                            target="_blank">{{ @$application->customer->customerDetail->tin_file }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Expire Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->customer->customerDetail->bin_expiry_date ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <hr class="hr-line" />
                        <!-- Tin End-->

                        <!-- ERC Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">ERC</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>
                                <span>
                                    @if ($application->customer->customerDetail->erc_file)
                                        <a href="{{ asset('upload/erc/' . $application->customer->customerDetail->erc_file) }}"
                                            class="text-decoration-underline"
                                            target="_blank">{{ @$application->customer->customerDetail->erc_file }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Expire Date</p>
                            <p class="d-flex align-items-center gap-3">
                                <span>:</span><span>{{ @$application->customer->customerDetail->bin_expiry_date ?? 'N/A' }}</span>
                            </p>
                        </div>
                        <hr class="hr-line" />
                        <!-- ERC End-->

                        <!--NOC Start-->
                        {{-- <div class="d-flex align-items-center gap-3 fa-details-text">
                        <p class="fw-semibold">NOC</p>
                        <p class="d-flex align-items-center gap-3">
                            <span>:</span>

                            <span>
                                @if ($application->customer->customerDetail->noc_file)
                                    <a href="{{ asset('upload/noc' . @$application->customer->customerDetail->noc_file) }}"
                                        class="text-decoration-underline"
                                        target="_blank">{{ @$application->customer->customerDetail->noc_file }}</a>
                                @else
                                    N/A
                                @endif

                            </span>
                        </p>
                    </div>
                    <hr class="hr-line" /> --}}
                        <!--NOC End-->

                        <!--Nid Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">NID</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->customer->customerDetail->nid_file)
                                        <a href="{{ asset('upload/nid/' . $application->customer->customerDetail->nid_file) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->customer->customerDetail->nid_file }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!--Nid End-->

                        <!-- Proforma Invoice Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Proforma Invoice</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->proforma_invoice)
                                        <a href="{{ asset('upload/customer/' . $application->proforma_invoice) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->proforma_invoice }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!-- Proforma Invoice End-->

                        <!-- Packing List Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Packing List</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->packing_list)
                                        <a href="{{ asset('upload/customer/' . $application->packing_list) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->packing_list }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!-- Packing List End-->

                        <!-- Test Parameter Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Test Parameter</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->test_parameter)
                                        <a href="{{ asset('upload/customer/' . $application->test_parameter) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->test_parameter }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!-- Test Parameter End-->

                        <!-- Declaration Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Declaration</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->declaration)
                                        <a href="{{ asset('upload/customer/' . $application->declaration) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->declaration }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!-- Declaration End-->


                        <!--Others Document Start-->
                        <div class="d-flex align-items-center gap-3 fa-details-text">
                            <p class="fw-semibold">Others</p>

                            <p class="d-flex align-items-center gap-3">
                                <span>:</span>

                                <span>
                                    @if ($application->upload_document)
                                        <a href="{{ asset('upload/customer/' . $application->upload_document) }}"
                                            class="text-decoration-underline" target="_blank">
                                            {{ @$application->upload_document }}</a>
                                    @else
                                        N/A
                                    @endif

                                </span>
                            </p>


                        </div>
                        <!--Others Document End-->

                    </div>
                </div>
            </div>
        @endif
    </div>


    <!-- view remark modal start -->
    <div class="modal fade" id="viewRemarkModal" tabindex="-1" aria-labelledby="viewRemarkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="viewRemarkModalLabel">Remark</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea name="remarks" id="remarks" rows="6" readonly class="form-control py-2 small-text-12">Please correct your text</textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->



    <!-- FA first process modal start -->
    <div class="modal fade" id="faProcessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="faProcessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="faProcessModalLabel">Proceed</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('fa.first.process') }}" method="POST" class="login-field"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-3">
                            <label class="mb-2">Assign FSO</label>
                            <select name="assign_user" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="" disabled>Select</option>
                                @foreach ($rfso_users as $rfso_user)
                                    <option value="{{ $rfso_user->id }}">{{ $rfso_user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Assign Lab</label>
                            <select name="lab_user" class="form-select search-input-field py-2" required>
                                <option value="" selected="" disabled>Select</option>
                                @foreach ($lab_users as $lab_user)
                                    <option value="{{ $lab_user->id }}">{{ $lab_user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Assign Date</label>
                            <input type="date" name="assign_date" class="form-control py-2 small-text-12" required />
                        </div>

                        <div class="mb-3">
                            <label for="contact-num" class="mb-2">Upload</label>
                            <div>
                                <input type="file" name="doc_file[]"
                                    class="form-control form-control input-style py-2 small-text-12" multiple />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12" required></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FA first process modal end -->

    <!-- On hold modal start -->
    <div class="modal fade" id="onholdModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="onholdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="onholdModalLabel">On Hold</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('onhold.process') }}" method="POST" class="login-field">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                        <div class="mb-4">
                            <label for="remark" class="mb-2">Remarks</label>
                            <textarea name="remark" id="remark" rows="6" class="form-control py-2 small-text-12"
                                placeholder="Please write your remark" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- On hold modal end -->



    {{-- FSO --}}

    <!-- fso process modal start -->
    <div class="modal fade" id="proceedRfsoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="proceedRfsoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="proceedRfsoModalLabel">Proceed</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('rfso.process') }}" method="POST" class="login-field"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        {{-- <div class="mb-3">
                            <label class="mb-2">Assign Lab</label>
                            <select name="assign_user" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="" disabled>Select</option>
                                @foreach ($lab_users as $lab_user)
                                    <option value="{{ $lab_user->id }}">{{ $lab_user->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="mb-3">
                            <label for="contact-num" class="mb-2">Upload</label>
                            <div>
                                <input type="file" name="doc_file[]"
                                    class="form-control form-control input-style py-2 small-text-12" multiple required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12" required></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- fso process modal end -->


    {{-- LAB --}}

    <!-- lab proceed modal start -->
    <div class="modal fade" id="proceedLabModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="proceedLabModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="proceedLabModalLabel">
                        Proceed
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('lab.process') }}" method="POST" class="login-field"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-3">
                            <label for="reference_no" class="mb-2">Reference No. of the test report</label>
                            <input type="text" name="reference_no" id="reference_no"
                                class="form-control py-2 small-text-12" placeholder="Reference No" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact-num" class="mb-2">Upload</label>
                            <div>
                                <input type="file" name="doc_file[]"
                                    class="form-control form-control input-style py-2 small-text-12" multiple required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12" required></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    {{-- FA 2 --}}

    <!-- Fa proceed modal start -->
    <div class="modal fade" id="proceedFa2Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="proceedFa2ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="proceedFa2ModalLabel">
                        Proceed
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('fa.second.process') }}" method="POST" class="login-field"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-3">
                            <label for="contact-num" class="mb-2">Upload</label>
                            <div>
                                <input type="file" name="doc_file[]"
                                    class="form-control form-control input-style py-2 small-text-12" multiple />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12" required></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    <!-- LAb Resampling modal start -->
    <div class="modal fade" id="labResamplingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="labResamplingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="labResamplingModalLabel">
                        Resampling
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <form action="{{ route('lab.resampling') }}" method="POST" class="login-field">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <label for="remark" class="mb-2">Remarks</label>
                            <textarea name="remark" id="remark" rows="6" class="form-control py-2 small-text-12" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

















    <!-- FA Resampling modal start -->
    <div class="modal fade" id="faResamplingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="faResamplingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="faResamplingModalLabel">Proceed</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('fa.resampling') }}" method="POST" class="login-field"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-3">
                            <label class="mb-2">Assign FSO</label>
                            <select name="assign_user" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="" disabled>Select</option>
                                @foreach ($rfso_users as $rfso_user)
                                    <option value="{{ $rfso_user->id }}"
                                        {{ @$rfso_user->id == @$faFirstProcess->assign_user_id ? 'selected' : '' }}>
                                        {{ $rfso_user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Assign Date</label>
                            <input type="date" name="assign_date" value="{{ @$faFirstProcess->assign_date }}"
                                class="form-control py-2 small-text-12" />
                        </div>
                        <div class="mb-3">
                            <label for="contact-num" class="mb-2">Upload</label>
                            <div>
                                <input type="file" name="doc_file[]"
                                    class="form-control form-control input-style py-2 small-text-12" multiple />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12">{{ @$faFirstProcess->remark }}</textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FA Resampling modal end -->












    {{-- <!-- Resampling modal start -->
    <div class="modal fade" id="resamplingModal" tabindex="-1" aria-labelledby="resamplingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="resamplingModalLabel">
                        Resampling
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" class="login-field">
                        <div class="mb-4">
                            <label for="on-hold-remarks" class="mb-2">Remarks</label>
                            <textarea name="on-hold-remarks" id="on-hold-remarks" rows="6" class="form-control py-2 small-text-12" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end --> --}}


    {{-- REJECTED --}}

    <!-- rejectModal modal start -->
    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="rejectModalLabel">Reject</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" method="POST" class="login-field" id="rejectForm">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <label for="remark" class="mb-2">Remarks</label>
                            <textarea name="remark" id="remark" rows="6" class="form-control py-2 small-text-12" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->






    <!-- FA Forward User Modal Start -->
    <div class="modal fade" id="forwardFAModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwardFAModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="forwardFAModalLabel">
                        Forward
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('fa.forward.user') }}" method="POST" class="login-field" id="forwardForm">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <label for="forward-to" class="mb-2">Forward to</label>
                            <select name="forward_user_id" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="">Please Select</option>
                                @foreach ($faForwardUsers as $faForwardUser)
                                    <option value="{{ $faForwardUser->id }}">{{ $faForwardUser->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FA Forward User Modal end -->



    <!-- Forward Director modal start -->
    <div class="modal fade" id="forwardDirectorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwardDirectorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="forwardDirectorModalLabel">
                        Forward
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('director.forward.user') }}" method="POST" class="login-field"
                        id="forwardForm">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <label for="forward-to" class="mb-2">Forward to</label>
                            <select name="forward_user_id" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="">Please Select</option>
                                @foreach ($directorForwardUsers as $directorForwardUser)
                                    <option value="{{ $directorForwardUser->id }}">{{ $directorForwardUser->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    <!-- forward SO modal start -->
    <div class="modal fade" id="forwardSOModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwardSOModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="forwardSOModalLabel">
                        Forward
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('so.forward.user') }}" method="POST" class="login-field" id="forwardForm">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <label for="forward-to" class="mb-2">Forward to</label>
                            <select name="forward_user_id" class="form-select search-input-field py-2"
                                aria-label="Default select example" required>
                                <option value="" selected="">Please Select</option>
                                @foreach ($soForwardUsers as $soForwardUser)
                                    <option value="{{ $soForwardUser->id }}">{{ $soForwardUser->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    <!-- SO, DIRECTOR, MEMBER, DIRECTOR proceed modal start -->
    <div class="modal fade" id="fiveToEightProceedModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="fiveToEightProceedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="fiveToEightProceedModalLabel">
                        Proceed
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" method="POST" class="login-field" id="proceedModal">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-3">
                            <label class="mb-2">Remark</label>
                            <textarea name="remark" rows="3" class="form-control py-2 small-text-12" required></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-process">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->


    <!-- Final modal end -->
    <div class="modal fade" id="soProceedFinalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="soProceedFinalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h2 class="modal-title fs-6 dashboard-title" id="soProceedFinalModalLabel">Approve</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('so.finalized.process') }}" method="POST" class="login-field">
                        @csrf

                        <input type="hidden" name="application_id" value="{{ $application->id }}">

                        <div class="mb-4">
                            <h5>Are you sure you want to approve?</h5>
                            {{-- <label for="issued_date" class="mb-2">Issued Date</label>
                            <input type="date" name="issued_date" id="issued_date"
                                class="form-control py-2 small-text-12" required> --}}

                        </div>

                        <div class="mt-3 mb-3 float-end">
                            <button type="submit" class="btn btn-process">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

@endsection

@push('js')
    <script>
        function proceed(param) {
            if (param == 'SO') {
                $('#fiveToEightProceedModal').modal('show');
                $('#proceedModal').attr('action', '{{ route('so.first.process') }}');
            } else if (param == 'director1') {
                $('#fiveToEightProceedModal').modal('show');
                $('#proceedModal').attr('action', '{{ route('director.first.process') }}');
            } else if (param == 'member1') {
                $('#fiveToEightProceedModal').modal('show');
                $('#proceedModal').attr('action', '{{ route('member.first.process') }}');
            } else if (param == 'director2') {
                $('#fiveToEightProceedModal').modal('show');
                $('#proceedModal').attr('action', '{{ route('director.second.process') }}');
            }
        }


        function rejectApplication(param) {
            if (param == 'fa2') {
                $('#rejectModal').modal('show');
                $('#rejectForm').attr('action', '{{ route('fa.second.reject') }}');
            } else if (param == 'so1') {
                $('#rejectModal').modal('show');
                $('#rejectForm').attr('action', '{{ route('so.first.reject') }}');
            } else if (param == 'finalReject') {
                $('#rejectModal').modal('show');
                $('#rejectForm').attr('action', '{{ route('so.final.reject') }}');
            }
        }

        //SHOW REMARKS
        $(document).ready(function() {
            $('body').on('click', '.viewRemark', function() {
                var remarkURL = $(this).data('url');

                $.get(remarkURL, function(data) {
                    $('#viewRemarkModal').modal('show');
                    $('#remarks').text(data.remark);
                })
            });
        });
    </script>
@endpush

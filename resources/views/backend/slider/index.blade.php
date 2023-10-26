@extends('backend.master')

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">Slider Manage</h1>

            {{-- @if (Auth::user()->hasPermission('sliders.create'))
            <div>
                <a href="{{ route('sliders.create') }}">
                    <button class="btn btn-application">
                        <i class="fa-solid fa-circle-plus puls-app"></i>
                        Create
                    </button>
                </a>
            </div>
            @endif --}}
        </div>

        <!-- table -->
        <div class="table-contanier">
            <table id="dataTable" class="cell-border display table-content" style="width: 100%">
                <thead>
                    <tr class="table-th">
                        <th class="text-center">#SL</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Status</th>
                        @if (Auth::user()->hasPermission('sliders.edit') || Auth::user()->hasPermission('sliders.destroy'))
                        <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($sliders as $key => $slider)
                        <tr>
                            <td class="table-td text-muted">#{{ $key += 1 }}</td>
                            <td class="table-td">
                                <img src="{{ @$slider->image ? asset('upload/slider/' . $slider->image) : '' }}"
                                    alt="" width="50">
                            </td>
                            <td class="table-td">{{ $slider->title }}</td>
                            <td class="table-td">
                                <span class="badge bg-{{ $slider->status == 1 ? 'success' : 'danger' }}">
                                    {{ $slider->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="table-td">
                                <!--Edit btn start-->
                                @if (Auth::user()->hasPermission('sliders.edit'))
                                <a href="{{ route('sliders.edit', $slider->id) }}"
                                    class="btn btn-action">
                                    <i class="fa fa-edit"></i>
                                    Edit
                                </a>
                                @endif
                                <!--Edit btn end-->

                                <!--Delete btn start-->
                                {{-- @if (Auth::user()->hasPermission('sliders.destroy'))
                                <button type="button" onclick="deleteData({{ $slider->id }})"
                                    class="btn btn-action-remark" title="Delete">
                                    <i class="fa fa-trash-alt"></i>
                                    <span>Delete</span>
                                </button>


                                <form id="delete-form-{{ $slider->id }}" method="POST"
                                    action="{{ route('sliders.destroy', $slider->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif --}}
                                <!--Delete btn end-->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- main body content end -->
@endsection

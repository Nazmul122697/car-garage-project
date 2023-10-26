@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="main-container">
        <div class="all-application-content">
            <h1 class="page-title">{{ @$role ? 'Edit Role' : 'Create Role' }}</h1>
            <div>
                <a href="{{ route('roles.index') }}" class="btn btn-action-remark">
                    <i class="fa fa-arrow-circle-left"></i>
                    Back
                </a>
            </div>
        </div>

        <!-- role-->
        <form method="POST" action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}">
            @csrf

            @isset($role)
                @method('PUT')
            @endisset

            <div class="table-contanier">
                <div class="mb-3">
                    <div class="d-flex align-items-centertitle-2">
                        <h1 class="page-title">Manage Role</h1>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label form-control-label">Role Name</label>
                        <input id="name" type="text" name="name"
                            class="form-control form-control-input @error('name') is-invalid @enderror"
                            value="{{ $role->name ?? old('name') }}" placeholder=" Enter role name" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="mt-4 text-center title-2">
                        <h1 class="page-title">Manage permissions for role</h1>
                    </div>

                    <div class="login-field">
                        <input type="checkbox" name="all-role" id="select-all" class="form-check-input" />
                        <label for="select-all" class="ms-2">Select All</label>
                    </div>
                </div>

                @forelse($modules->chunk(2) as $key=>$chunks)
                    <div class="row">
                        @foreach ($chunks as $key => $module)
                            <div class="col-12 col-md-6 ">
                                <p class="role-sub-title">Module: {{ $module->name }}</p>

                                @foreach ($module->permissions as $key => $permission)
                                    <div class="login-field">
                                        <input type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}"
                                                    @isset($role)
                                                        @foreach ($role->permissions as $rPermission)
                                                            {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endisset/>
                                        <label for="permission-{{ $permission->id }}" class="ms-2">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="row">
                        <div class="col text-center">
                            <strong>No module found.</strong>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 text-center">
                <button type="submit" class="btn btn-continue">
                    <i class="fa {{ @$role ? 'fa-arrow-circle-up' : 'fa-plus-circle' }}"></i>
                    <span>{{ @$role ? 'Update Role' : 'Save Role' }}</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $('#select-all').click(function(event) {

            if (this.checked) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });

            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush

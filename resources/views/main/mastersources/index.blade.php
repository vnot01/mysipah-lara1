@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">

    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lists of Sources</li>
            </ol>
            <button type="button" class="btn btn-primary btn-icon-text"
                data-bs-toggle="modal" data-bs-target="#modalNewIncoming"
                data-bs-whatever="@getbootstrap">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create Sources</button>

                <div class="modal fade" id="modalNewIncoming"
                    tabindex="-1" aria-labelledby="modalNewIncomingLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalNewIncomingLabel">Add New Sources</h5>
                          <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                              <div class="mb-3">
                                <label for="sources-name" class="form-label">Sources Waste</label>
                                <select class="my-select2 form-select" data-width="100%">
                                    <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="sources-name" class="form-label">Types Waste</label>
                                <select class="my-select2 form-select" data-width="100%">
                                    <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="sources-name" class="form-label">Manufactures Waste</label>
                                <select class="my-select2 form-select" data-width="100%">
                                    <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="volume" class="form-label">Volume (kg):</label>
                                <input type="text" class="form-control" id="volume">
                                {{-- <label for="message-text" class="form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea> --}}
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            {{-- <h6 class="card-title"><a href="{{ route('admin.dashboard') }}">Incoming Waste</h6> --}}
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Sources</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($listSources as $source)
                  <tr>
                    <td>1</td>
                    <td>{{ $source->nama }}</td>
                    <td class="text-center">
                        <form
                            onsubmit="return confirm('Are You Sure ?');"
                            action="{{ route('main.master_sources.destroy', $source->id) }}" method="POST">
                            {{-- <a href="{{ route('main.master_sources.show', $source->id) }}" class="btn btn-sm btn-dark">SHOW</a> --}}
                            <a href="{{ route('main.master_sources.edit', $source->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                        </form>
                    </td>
                  </tr>
                  @empty
                    <div class="alert alert-danger">
                        No Data Available.
                    </div>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $source->links() }} --}}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection

@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">

    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incoming Waste</li>
            </ol>
            <button type="button" class="btn btn-primary btn-icon-text"
                data-bs-toggle="modal" data-bs-target="#modalNewIncoming"
                data-bs-whatever="@getbootstrap">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                New Incoming Waste</button>
                {{-- <div class="modal fade" id="exampleModal"
                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">New Incoming Waste</h5>
                          <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                          <div class="mb-3">
                            <label for="recipient-name" class="form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <div class="mb-3">
                                <label for="sources-name" class="form-label">Sources Waste</label>
                                <select class="js-example-basic-single form-select" data-width="100%">
                                    <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sources-name" class="form-label">Sources Waste</label>
                                <select class="my-select2 form-select">
                                    <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option>
                                </select>
                            </div>

                          <div class="mb-3">
                            <label for="message-text" class="form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                          </div>

                        </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                </div> --}}

                <div class="modal fade" id="modalNewIncoming"
                    tabindex="-1" aria-labelledby="modalNewIncomingLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalNewIncomingLabel">New Incoming Waste</h5>
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
                    <th>ID Customer</th>
                    <th>Source</th>
                    <th>Type</th>
                    <th>Manufacture</th>
                    <th>Vol (kg)</th>
                    <th>Last Update</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>1234</td>
                    <td>Rumah Tangga</td>
                    <td>Recycle</td>
                    <td>Others</td>
                    <td>3.1</td>
                    <td>2023-07-15</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>4321</td>
                    <td>Rumah Tangga</td>
                    <td>Residu</td>
                    <td>Others</td>
                    <td>10.1</td>
                    <td>2023-07-15</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection

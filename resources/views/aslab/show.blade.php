@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-sm-6">
        <h3>Assistant Laboratory Details</h3>
      </div>
      <div class="col-12 col-sm-6 text-end">
        <a href="{{ route('aslabs.index') }}" class="btn btn-primary">
          <i class="fa fa-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('aslabs.edit', $aslab->id) }}" class="btn btn-warning">
          <i class="fa fa-edit"></i> Edit
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-xl-6 col-sm-12">
              <div class="product-details">
                <table class="product-page-width">
                  <tbody>
                    <tr>
                      <td><b>Name &nbsp;&nbsp;&nbsp;:</b></td>
                      <td>{{ $aslab->name }}</td>
                    </tr>
                    <tr>
                      <td><b>Position &nbsp;&nbsp;&nbsp;:</b></td>
                      <td>{{ $aslab->position }}</td>
                    </tr>
                    <tr>
                      <td><b>Social Media &nbsp;&nbsp;&nbsp;:</b></td>
                      <td>{{ $aslab->social_media ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                      <td><b>Created At &nbsp;&nbsp;&nbsp;:</b></td>
                      <td>{{ $aslab->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                    <tr>
                      <td><b>Last Updated &nbsp;&nbsp;&nbsp;:</b></td>
                      <td>{{ $aslab->updated_at->format('d M Y H:i:s') }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-xl-6 col-sm-12 text-center">
              <div class="product-img-section">
                @if ($aslab->image)
                  <img class="img-fluid" src="{{ asset('storage/aslab_images/'.$aslab->image) }}" alt="{{ $aslab->name }}" style="max-height: 300px;">
                @else
                  <div class="alert alert-info">
                    <i class="fa fa-info-circle me-2"></i>No image available for this assistant laboratory staff.
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-end">
          <form action="{{ route('aslabs.destroy', $aslab->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="handleDelete({{ $aslab->id }})" data-bs-toggle="modal" data-bs-target="#delete-modal">
              <i class="fa fa-trash"></i> Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<form method="POST" id="delete-form" action="{{ route('aslabs.destroy', $aslab->id) }}">
  @csrf
  @method('DELETE')
  <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Are you sure you want to delete?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Deleted data cannot be recovered!</div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Delete</button>
        </div>
      </div>
    </div>
  </div>
</form>

@section('js')
<script>
  function handleDelete(id) {
    $('#delete-form').attr('action', `{{ url('aslabs/${id}') }}`);
  }
</script>
@endsection

@endsection
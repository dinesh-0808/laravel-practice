<x-admin-master>
    @section('content')
        <h1>Users</h1>
        @if(Session::has('not-authorized-message'))
        <div class="alert alert-danger">
          {{ Session::get('not-authorized-message') }}
        </div>
        @elseif(Session('user-deleted-message'))
        <div class="alert alert-success">
          {{ Session::get('user-deleted-message') }}
        </div>
        @endif
        @if ($users->count()>0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">User Posts</h6>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Avatar</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Delete User</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete User</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($users as $user)
  
                    <tr>
                        <td><a href="#">{{ $user->id }}</a></td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            <img src="{{ $user->avatar }}" height="40px" alt="not found">
                        </td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            @if ($user->id!==Auth::user()->id)
                            <form action="{{ route('user.destroy',$user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="delete">
                            </form>

                            @else
                            <p>myself</p>

                            @endif
                        </td>
                    </tr>
                        
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        @endif
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> 
    @endsection
</x-admin-master>
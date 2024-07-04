<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
        @if(Session::has('post-deleted-message'))
        <div class="alert alert-danger">
          {{ Session::get('post-deleted-message') }}
        </div>
        @elseif(Session('post-created-message'))
        <div class="alert alert-success">
          {{ Session::get('post-created-message') }}
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>User</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>User</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($posts as $post)

                    <tr>
                        <td><a href="{{ route('post.edit',$post->id) }}">{{ $post->id }}</a></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ $post->image }}" height="40px" alt="not found">
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <form action="{{ route('post.destroy',$post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="delete">
                            </form>
                        </td>
                    </tr>
                        
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="d-flex">
            <div class="mx-auto">
              {{ $posts->links() }}
            </div>
          </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>  --}}
    @endsection
</x-admin-master>
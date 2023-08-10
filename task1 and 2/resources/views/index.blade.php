<!doctype html>
<html lang="en">
  <head>
    <title>Blogs</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="navId">
        <li class="nav-item">
            <a href="#tab1Id" class="nav-link disabled">Home</a>
        </li>
        <li class="nav-item">
            <a href="#tab5Id" class="nav-link active">Blogs</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">About</a>
        </li>
    </ul>
    
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8">
                <h2>Blogs List</h2>
                @forelse( $blogs as $blog)
                <div class="card mt-2" >
                          <img src="{{asset('images/'.$blog->image)}}" height="400px" width="auto" class="card-img-top" alt="Image">
                          <div class="card-body">
                            <h5 class="card-title">{{$blog->title}}<span class="float-right ml-3" style="font-size:10px;">{{ date('D M, Y h:i a',strtotime($blog->created_at)) }} /  posted by: {{$blog->posted_by}}</span></h5>
                            <p class="card-text">{!! $blog->description !!}</p>
                          </div>
                        </div>
                @empty
                    <p>No Blogs created!</p>
                @endforelse
            </div>  
            <div class="col-md-4">
                <h2>Create New Blog</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" id="" placeholder="Enter title" aria-describedby="fileHelpId">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea  class="form-control" name="description" id="" placeholder="Description" aria-describedby="fileHelpId"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="">Blog Image</label>
                      <input type="file" class="form-control-file" name="image" accept="image/*" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Posted By</label>
                        <select name="posted_by" class="form-control">
                            <option value="SuperAdmin">SuperAdmin</option>
                            <option value="Admin">Admin</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary btn">Add</button>
                </form>
            </div>  
    
        </div>  
    
    </div>  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
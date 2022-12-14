<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Change Vendor Profile Picture</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: black">
    <div style=" 
      border-radius: 10px;
      width: 400px;
      background-color:aqua;
      padding: 20px 10px;
    color: white;">
      <form action="{{route('updateVendorImage')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" name="image" class="form-control w-100">
        <div>
          @error('image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <input type="text" hidden name="id" value="{{ $vendor->id }}">
        <input type="text" hidden name="name" value="{{ $vendor->name }}">
        <input type="text" hidden name="role" value="{{ $vendor->role }}">
        <input type="text" hidden name="email" value="{{ $vendor->email }}">
        <input type="text" hidden name="password" value="{{ $vendor->password }}">
        <input type="text" hidden name="address" value="{{ $vendor->address }}">
        <input type="text" hidden name="phone" value="{{ $vendor->phone }}">
        <input type="text" hidden name="status" value="{{ $vendor->status }}">
        <button type="submit" class="btn btn-primary btn-sm mt-3">Upload Photo</button>
        <a class="btn btn-sm btn-danger mt-3 px-4"  style="margin-left:190px" href="{{ route('vendorDashboard') }}">Back</a>  
      </form>
    </div>
  </div>
</body>

</html>
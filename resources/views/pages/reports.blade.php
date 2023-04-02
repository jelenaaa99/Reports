<!DOCTYPE html>
<html lang="en">
@include('fixed.head')
<body>

    <div class="border-bottom mt-2">
        <div class="container d-flex justify-content-between pb-1">
            <div>Reports</div>
            <div>
                <span>John Smith</span>
                <span class="mx-2"><i class="fa-regular fa-bell"></i> <span class="circle rounded-circle position-relative"></span></span>
                <span class="arrow-container">
                    <span class="position-relative arrow-right"><i class="fa-solid fa-arrow-right"></i></span>
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <h4>List of reports</h4>

        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Report name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Report 1</td>
                    <td>
                        <form action="{{route('download-excel')}}" method="get">
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>Report 2</td>
                    <td>
                        <form action="{{route('download-xml')}}" method="get">
                            <button type="submit" class="btn btn-primary">Download</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        @if(Session::get('error'))
        <p class="alert alert-danger">{{Session::get('error')}}</p>
        @endif
    </div>
@include('fixed.scripts')
</body>
</html>
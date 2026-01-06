@extends('admin.admin_dashboard')
@section('admin')

 

<div class="container mt-4">
    <h3>Vouchers for: {{ $user->name }}</h3>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Voucher Code</th>
                <th>Used?</th>
                <th>Expire Time</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{ $voucher->id }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->is_used ? 'Yes' : 'No' }}</td>
                    <td>{{ $voucher->expired_at }}</td>
                    <td>
                        <form action="{{ route('admin.send.voucher', $voucher->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                Send WhatsApp
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>




@endsection

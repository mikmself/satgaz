@extends('pages.master.main')
@section('title','Notifikasi')
@section('content')
    <div class="row" id="table-striped">
        <div class="col-12">
            <div class="card">
                <div class="card-content p-4">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <th class="text-bold-500">{{ $notification->title }}</th>
                                    <td>{{ $notification->content }}</td>
                                    <th>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

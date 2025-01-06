@extends('site.layout.layout')
@section('content')

<section class="product-details spad">
    <div class="container-fluid">
        <div class="row ml-5">
            <section class="col-lg-10 connectedSortable ml-5">
                <div class="card direct-chat direct-chat-primary ml-5">
                    <div class="card-header">
                        <h3 class="card-title">{{$ticket->subject}}</h3>
                    </div>
                    @if(!empty($ticket->ticketmessage) && $ticket->ticketmessage->count() > 0)
                        @foreach ($ticket->ticketmessage as $message)                        
                            <div class="card-body">
                                <div class="direct-chat-messages">
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left"><b>{{$message->sender->name}}</b></span>
                                            <span class="direct-chat-timestamp float-right">{{$message->created_at}}</span>
                                        </div>
                                        <div class="direct-chat-text">
                                            {{$message->messages}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="card-footer">
                        <form action="{{route('ticket.message.create', $ticket->id)}}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Gönder</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>


@endsection
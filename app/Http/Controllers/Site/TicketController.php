<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function TicketCreate(Product $product,Request $request){
        
        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'product_id' => $product->id,
            'recipient_id' => $product->stores->user->id,
            'status' => 'open',
        ]);

        return back()->withSuccess('Destek Talebiniz Oluşturuldu Sağ Üstten Mesaj Kısmına Bakabilirsiniz.');
    }

    public function TicketList(){
        $tickets = Ticket::where('user_id',Auth::id())->orWhere('recipient_id',Auth::id())->orderBy('id','desc')->get();
        return view('site.pages.message.messagelist',compact('tickets'));
    }

    public function TicketDetail(Ticket $ticket){
        return view('site.pages.message.message',compact('ticket'));
    }

    public function TicketMessageCreate(Ticket $ticket,Request $request){

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'sender_id' => Auth::id(),
            'messages' => $request->message,
        ]);
        return back()->withSuccess('Mesajınız Başarıyla Gönderilmiştir.');

    }
}

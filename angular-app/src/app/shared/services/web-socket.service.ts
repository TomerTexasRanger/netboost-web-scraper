import { Injectable } from '@angular/core';
import { Subject, Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class WebSocketService {
  private socket!: WebSocket;
  private messages: Subject<any> = new Subject();

  constructor() { }

  public connect(url: string): void {
    this.socket = new WebSocket(url);

    this.socket.onmessage = (event) => {
      this.messages.next(event.data);
    };
  }

  public getMessages(): Observable<any> {
    return this.messages.asObservable();
  }

  public sendMessage(message: any): void {
    this.socket.send(JSON.stringify(message));
  }
}

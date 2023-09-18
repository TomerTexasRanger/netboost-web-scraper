import { Component } from '@angular/core';
import {WebSocketService} from "./shared/services/web-socket.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'angular-app';
  constructor(private webSocketService: WebSocketService) {
  }

  ngOnInit(): void {
    // this.webSocketService.connect('ws://localhost:6001');
    //
    // this.webSocketService.getMessages().subscribe((message) => {
    //   console.log('Received a message:', message);
    // });
  }
}

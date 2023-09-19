import {Component, ViewChild, AfterViewInit, OnInit, OnDestroy} from '@angular/core';
import {TargetFormInterface} from "./form/form.component";
import {TargetService} from "../shared/services/http/target.service";
import {TargetModel} from "../shared/models/target.model";
import {MatPaginator} from "@angular/material/paginator";
import {MatTableDataSource} from "@angular/material/table";
import {LinkInterface} from "../shared/interfaces/target.interface";
import {MatDialog, MatDialogRef} from "@angular/material/dialog";
import {LinksDialogComponent} from "../links-dialog/links-dialog/links-dialog.component";
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';
import {values} from "pusher-js/types/src/core/utils/collections";

@Component({
  selector: 'app-targets',
  templateUrl: './targets.component.html',
  styleUrls: ['./targets.component.scss']
})
export class TargetsComponent implements OnInit, AfterViewInit, OnDestroy {
  echo!: Echo;
  displayedColumns: string[] = ['url', 'title', 'links', 'actions'];
  dataSource = new MatTableDataSource<TargetModel>([]);
  @ViewChild(MatPaginator) paginator!: MatPaginator;

  constructor(private targetService: TargetService, public dialog: MatDialog) {
  }
  ngOnInit(): void {
    (window as any).Pusher = Pusher;

    this.echo  = new Echo({
      broadcaster: 'pusher',
      key: 'f0dd53e89b8cc735d2a7',
      wsHost: window.location.hostname,
      wsPort: 6001,
      cluster: 'mt1',
      forceTLS: true,
      disableStats: true,
    });

    this.echo.channel('scraper-links')
      .listen('.scraper-links', (data: any) => {
      this.dataSource.data = data;
      });

  }
  ngAfterViewInit() {
    this.dataSource.paginator = this.paginator;
  }

  submitUrl(values: TargetFormInterface) {
    this.targetService.store(values).subscribe({
      next: value => {
        this.dataSource.data = value;
      }
    });
  }


  onLinkClick(links: LinkInterface): void {
    this.dialog.open(LinksDialogComponent, {
      data: {links},
    });
  }

  onActionClick(element: TargetFormInterface): void {
    console.log(element);
  }

  ngOnDestroy(): void {
    this.echo.leave('scraper-links');

  }
}

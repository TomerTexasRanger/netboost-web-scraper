import {Component, Inject} from '@angular/core';
import {MAT_DIALOG_DATA} from "@angular/material/dialog";
import {LinkInterface} from "../../shared/interfaces/target.interface";

@Component({
  selector: 'app-links-dialog',
  templateUrl: './links-dialog.component.html',
  styleUrls: ['./links-dialog.component.scss']
})
export class LinksDialogComponent {
  constructor(@Inject(MAT_DIALOG_DATA) public data: { links: LinkInterface[] }) { }

}

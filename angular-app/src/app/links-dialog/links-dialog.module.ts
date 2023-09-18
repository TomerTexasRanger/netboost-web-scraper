import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LinksDialogComponent } from './links-dialog/links-dialog.component';
import {MatDialogModule} from "@angular/material/dialog";
import {MatButtonModule} from "@angular/material/button";



@NgModule({
  declarations: [
    LinksDialogComponent
  ],
  imports: [
    CommonModule,
    MatDialogModule,
    MatButtonModule,

  ]
})
export class LinksDialogModule { }

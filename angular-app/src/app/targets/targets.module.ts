import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TargetsComponent } from './targets.component';
import {RouterModule, Routes} from "@angular/router";
import { FormComponent } from './form/form.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {MatTooltipModule} from "@angular/material/tooltip";
import {MatTableModule} from "@angular/material/table";
import {MatPaginatorModule} from "@angular/material/paginator";
import {MatButtonModule} from "@angular/material/button";
import {LinksDialogModule} from "../links-dialog/links-dialog.module";

const routes: Routes = [
  {path: '', component: TargetsComponent},
];

@NgModule({
  declarations: [
    TargetsComponent,
    FormComponent,
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    FormsModule,
    ReactiveFormsModule,
    MatTooltipModule,
    MatTableModule,
    MatPaginatorModule,
    MatButtonModule,
    LinksDialogModule

  ]
})
export class TargetsModule { }

import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppComponent} from './app.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {HttpClient, HttpClientModule} from "@angular/common/http";
import {RouterLink, RouterModule, RouterOutlet, Routes} from "@angular/router";
import {PageNotFoundComponent} from './page-not-found/page-not-found.component';
import {LandingPageComponent} from './landing-page/landing-page.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

const routes: Routes = [
  {path: '', component: LandingPageComponent},
  {
    path: 'targets',
    loadChildren: () => import('./targets/targets.module').then(m => m.TargetsModule)

  },
  {path: '**', component: PageNotFoundComponent} // 404 route
];

@NgModule({
  declarations: [
    AppComponent,
    PageNotFoundComponent,
    LandingPageComponent
  ],
  imports: [
    RouterModule.forRoot(routes),
    BrowserModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    RouterOutlet,
    RouterLink,
    BrowserAnimationsModule,
  ],
  providers: [HttpClient],
  bootstrap: [AppComponent,]
})
export class AppModule {
}

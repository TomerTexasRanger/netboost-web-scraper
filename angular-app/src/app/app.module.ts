import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppComponent} from './app.component';
import {CrawlerComponent} from './crawler/crawler.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {HttpClient, HttpClientModule, HttpHandler} from "@angular/common/http";
import {RouterLink, RouterModule, RouterOutlet, Routes} from "@angular/router";
import {PageNotFoundComponent} from './page-not-found/page-not-found.component';
import {LandingPageComponent} from './landing-page/landing-page.component';

const routes: Routes = [
  {path: '', component: LandingPageComponent},
  {path: 'crawler', component: CrawlerComponent},
  {path: '**', component: PageNotFoundComponent} // 404 route
];

@NgModule({
  declarations: [
    AppComponent,
    CrawlerComponent,
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
  ],
  providers: [HttpClient],
  bootstrap: [AppComponent,]
})
export class AppModule {
}

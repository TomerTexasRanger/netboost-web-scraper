import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {CrawlerService} from "../shared/services/http/crawler.service";

interface CrawledUrlInterface {
  url: string;
  depth: number;
  content?: string;
}

@Component({
  selector: 'app-crawler',
  templateUrl: './crawler.component.html',
  styleUrls: ['./crawler.component.scss']
})
export class CrawlerComponent implements OnInit {
  crawledUrls: CrawledUrlInterface[] = [];
  form: FormGroup;

  constructor(private http: HttpClient, private fb: FormBuilder, private crawlService: CrawlerService) {
    this.form = fb.group({
      'url': [null, [Validators.required]],
      'depth': [null, [Validators.required]]
    })
  }

  ngOnInit(): void {

  }

  onSubmit() {
    const payload: CrawledUrlInterface = {url: this.form.get('url')?.value, depth: this.form.get('depth')?.value};
    this.crawlService.postData('crawl', payload).subscribe({
        next: data => this.crawledUrls = data as CrawledUrlInterface[],
      }
    );
  }

  updateCrawl(url: string, depth: number) {
    // Similar logic to onSubmit, but for updating
  }


}

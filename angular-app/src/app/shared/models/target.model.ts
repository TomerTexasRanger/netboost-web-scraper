export class TargetModel {
  id: string;
  url: string;
  title: string;
  created_at: string;
  links: LinkModel[]

  constructor(id: string, url: string, title: string, created_at: string, links: LinkModel[]) {
  this.id = id
  this.url = url
  this.title = title
  this.created_at = created_at
  this.links = links
  }
}

export class LinkModel {
  id: string;
  url: string;

  constructor(id: string, url: string) {
    this.id = id
    this.url = url
  }
}

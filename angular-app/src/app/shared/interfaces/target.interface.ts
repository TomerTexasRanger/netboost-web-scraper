export interface TargetInterface {
  id: string;
  url: string;
  title: string;
  created_at: string;
  links: LinkInterface[]
}

export interface LinkInterface {
  id: string;
  url: string;
}

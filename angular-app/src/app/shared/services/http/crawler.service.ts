import {Injectable} from "@angular/core";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {catchError, Observable, of} from "rxjs";

@Injectable({
  providedIn: 'root',
})
export class CrawlerService {

  private apiUrl = 'http://localhost/api/';

  httpOptions = {
    headers: new HttpHeaders({'Content-Type': 'application/json'})
  };

  constructor(private http: HttpClient) {
  }


  // GET request
  getData(endpoint: string): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${endpoint}`)
      .pipe(
        catchError(this.handleError<any>('getData', []))
      );
  }

  // POST request
  postData(endpoint: string, data: any): Observable<any> {
    return this.http.post<any>(`http://localhost/api/${endpoint}`, data, this.httpOptions)
      .pipe(
        catchError(this.handleError<any>('postData'))
      );
  }

  // PUT request
  updateData(endpoint: string, data: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/${endpoint}`, data, this.httpOptions)
      .pipe(
        catchError(this.handleError<any>('updateData'))
      );
  }

  // DELETE request
  deleteData(endpoint: string): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${endpoint}`, this.httpOptions)
      .pipe(
        catchError(this.handleError<any>('deleteData'))
      );
  }

  // Error handling
  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.error(error);
      return of(result as T);
    };
  }
}

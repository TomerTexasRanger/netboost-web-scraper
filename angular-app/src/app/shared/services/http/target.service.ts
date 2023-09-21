import {Injectable} from "@angular/core";
import {HttpClient, HttpErrorResponse, HttpHeaders, HttpResponse} from "@angular/common/http";
import {catchError, Observable, of} from "rxjs";
import {TargetInterface} from "../../interfaces/target.interface";
import Swal from 'sweetalert2'
@Injectable({
  providedIn: 'root',
})
export class TargetService {

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
  store(data: any): Observable<{message: string}> {
    return this.http.post<{message: string}>(`${this.apiUrl}targets/store`, data, this.httpOptions)
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
    return (error: HttpErrorResponse): Observable<T> => {
      if(error.status === 422){
        console.log(error)
  Swal.fire(error.error.errors.url[0])
      }
      return of(result as T);
    };
  }
}

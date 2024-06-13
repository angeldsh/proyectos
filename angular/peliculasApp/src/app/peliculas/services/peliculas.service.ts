import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';
import { Pelicula } from '../interfaces/pelicula.interface';
import { Genero } from '../interfaces/genero.interface';

@Injectable({
  providedIn: 'root'
})
export class PeliculasService {

  // Ruta base para todas las llamadas al servicio
  // se toma de environment
  private peliculasUrl = `${environment.peliculasBackendBaseUrl}/peliculas`;
  private generosUrl = `${environment.peliculasBackendBaseUrl}/generos`;

  private debug = environment.debug;

  constructor(
    // Necesitamos este objeto para hacer peticiones. 
    private httpClient: HttpClient
  ) { }

  /**
   *  Dado el filtro, retorna las peliculas que coinciden con el criterio
   */
  getPeliculas(filtro: string = ''): Observable<Pelicula[]> {

    // Calcula el recurso incluyendo el filtro
    let url: string = `${this.peliculasUrl}?_sort=titulo&_order=asc${(filtro.length) ? '&q=' + filtro : ''}`;

    // Retorna un observable
    return this.httpClient.get<Pelicula[]>(url);
  }

  getPeliculasDesc(): Observable<Pelicula[]> {
    let url: string = `${this.peliculasUrl}?_sort=titulo&_order=desc`;
    // Retorna un observable
    return this.httpClient.get<Pelicula[]>(url);
  }
  /**
   * Obtiene una pelicula
   */
  getPelicula(id: String): Observable<Pelicula> {

    // Calcula el recurso incluyendo el filtro
    const url: string = `${this.peliculasUrl}/${id}`;

    // Carga la pelicula
    return this.httpClient.get<Pelicula>(url);
  }


  /**
   * Borra una pelicula
   */
  borrarPelicula(pelicula: Pelicula): Observable<Pelicula> {

    // Calcula el recurso incluyendo el filtro
    const url: string = `${this.peliculasUrl}/${pelicula.id}`;

    // Llama a eliminar la pelicula
    return this.httpClient.delete<Pelicula>(url);
  }

  agregarPelicula(nuevaPelicula: Pelicula): Observable<Pelicula> {
    delete nuevaPelicula.id;
    const url: string = `${this.peliculasUrl}`;
    return this.httpClient.post<Pelicula>(url, nuevaPelicula);
  }

  actualizarPelicula(pelicula: Pelicula): Observable<Pelicula> {
    const url: string = `${this.peliculasUrl}/${pelicula.id}`;
    return this.httpClient.put<Pelicula>(url, pelicula);
  }
  getPeliculasPorTitulo(titulo: string): Observable<Pelicula[]> {
    const url: string = `${this.peliculasUrl}?titulo=${titulo}`;
    return this.httpClient.get<Pelicula[]>(url);
  }
  getPeliculasPorGenero(genero: string): Observable<Pelicula[]> {
    const url: string = `${this.peliculasUrl}?genero=${genero}`;
    return this.httpClient.get<Pelicula[]>(url);
  }
  getPeliculasPorLetra(letra: string): Observable<Pelicula[]> {
    const url: string = `${this.peliculasUrl}?titulo_like=^${letra}`;
    return this.httpClient.get<Pelicula[]>(url);
  }

  getGeneros(): Observable<Genero[]> {
    const url: string = `${this.generosUrl}`;
    return this.httpClient.get<Genero[]>(url);
  }
}
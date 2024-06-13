export interface Pelicula {
  id?: number;
  titulo: string;
  director: string;
  fechaEstreno?: string;
  edad?: string;
  reparto?: string[];
  genero?: string;
  sinopsis?: string;
  duracion?: string;
}
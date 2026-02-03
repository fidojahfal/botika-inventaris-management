export interface Department {
  id: number;
  name: string;
}

export interface User {
  id: number;
  name: string;
  jabatan: string;
  department: Department;
}

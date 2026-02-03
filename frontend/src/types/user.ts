export interface Department {
  id: number;
  name: string;
}

export interface Position {
  id: number;
  name: string;
}

export interface User {
  id: number;
  name: string;
  position: Position;
  department: Department;
}

export interface CreateUserPayload {
  name: string;
  position_id: number;
  department_id: number;
}

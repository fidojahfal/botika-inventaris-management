import type { Department } from "./user";

export interface BaseEntity {
  id: number;
  name: string;
}

export interface AssignedUser extends BaseEntity {}
export interface Status extends BaseEntity {}

export interface Inventaris {
  id: string;
  name: string;
  serial_number: string;
  spesifikasi: string;
  department: Department;
  assigned_user: AssignedUser;
  status: Status;
  type: string;
}

export interface CreateInventarisPayload {
  id: string;
  name: string;
  serial_number: string;
  spesifikasi: string;
  department_id: number;
  assigned_user_id: number;
  status_id: number;
  type: string;
}

export interface UpdateInventarisPayload extends CreateInventarisPayload {}

export interface Summary {
  baik: number;
  rusak: number;
  dilelang: number;
  tidak_dipakai: number;
}

export interface Chart {
  label: string;
  value: number;
}

export interface Analytics {
  summary: Summary;
  chart: Chart[];
}

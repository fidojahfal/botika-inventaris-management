import type {
  CreateInventarisPayload,
  Inventaris,
  UpdateInventarisPayload,
} from "../types/inventaris";
import api from "./axios";

export const getInventaris = async () => {
  const res = await api.get("/inventaris");

  return res.data.data;
};

export const createInventaris = async (
  payload: CreateInventarisPayload,
): Promise<Inventaris> => {
  const res = await api.post("/inventaris/create", payload);

  return res.data.data;
};

export const updateInventaris = async (
  id: string,
  payload: UpdateInventarisPayload,
): Promise<Inventaris> => {
  const res = await api.put(`/inventaris/${id}`, payload);
  return res.data.data;
};

export const deleteInventaris = async (id: string): Promise<string> => {
  const res = await api.delete(`/inventaris/${id}`);

  return res.data.message;
};

import type { CreateInventarisPayload, Inventaris } from "../types/inventaris";
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

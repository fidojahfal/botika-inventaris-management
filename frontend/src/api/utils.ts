import type { Position } from "../types/user";
import api from "./axios";

export const getPositions = async (): Promise<Position[]> => {
  const res = await api.get("/positions");

  return res.data.data;
};

export const getDepartments = async (): Promise<Position[]> => {
  const res = await api.get("/departments");
  
  return res.data.data;
};

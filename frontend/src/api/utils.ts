import type { AssignedUser, Status } from "../types/inventaris";
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

export const getStatusInventaris = async (): Promise<Status[]> => {
  const res = await api.get("/status/inventaris");

  return res.data.data;
};

export const getAssignedUser = async (): Promise<AssignedUser[]> => {
  const res = await api.get("/assigns");

  return res.data.data;
};

export const logout = async () => {
  const res = await api.post("/logout");

  return res.data.message;
};

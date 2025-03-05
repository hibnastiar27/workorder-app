import api from "./axiosInstance";

export const register = async (data: {
  name: string;
  email: string;
  password: string;
  role_id: string;
}) => {
  try {
    const response = await api.post("/register", data);
    return response.data;
  } catch (error: any) {
    throw error.response ? error.response.data : error;
  }
};

export const login = async (data: { email: string; password: string }) => {
  try {
    const response = await api.post("/login", data);
    return response.data;
  } catch (error: any) {
    throw error.response ? error.response.data : error;
  }
};

export const checkAuth = async (token: string) => {
  try {
    const response = await api.get("/user", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return response.data;
  } catch (error: any) {
    throw error.response ? error.response.data : error;
  }
};

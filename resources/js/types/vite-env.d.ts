// src/vite-env.d.ts
// Tells TypeScript about Vite's special import.meta.env object.
// Without this, TypeScript throws "Property 'env' does not exist on type 'ImportMeta'".
// The interfaces extend the built-in types that vite/client provides.

/// <reference types="vite/client" />

// declare every VITE_ variable you use in the app here
// only variables prefixed with VITE_ are exposed to the browser by Vite
// variables without VITE_ prefix stay server-side only
interface ImportMetaEnv {
    readonly VITE_API_URL: string;
  }
  
  interface ImportMeta {
    readonly env: ImportMetaEnv;
  }
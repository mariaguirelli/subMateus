import StyledComponentsRegistry from "@/lib/registry";
import { GlobalStyle } from "@/styles/global";
import type { Metadata } from "next";


export const metadata: Metadata = {
  title: "subMateus",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body suppressHydrationWarning={true}>
        <StyledComponentsRegistry>
          <GlobalStyle />
          {children}
        </StyledComponentsRegistry>
      </body>
    </html>
  );
}

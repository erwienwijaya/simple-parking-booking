<?php

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="AuthLogin",
     *      summary="Authentication Login",
     *      tags={"Authentication"},
     *
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="array",
     *              example={
     *                 "email": "demo@parking.id",
     *                 "password": "pass123"
     *              },
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                  )
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *               @OA\Property(
     *                  property="user",
     *                  type="array",
     *                  example={
     *                      "id": 1,
     *                      "name": "demo",
     *                      "email": "demo@parking.id",
     *                      "email_verified_at": null,
     *                      "created_at": "2021-11-18T12:52:12.000000Z",
     *                      "updated_at": "2021-11-18T12:52:12.000000Z"
     *                   },
     *                   @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email_verified_at",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                      ),
     *                      @OA\Property(
     *                         property="updated_at",
     *                         type="datetime",
     *                      )
     *                  )
     *            ),
     *            @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="Success",
     *                   description="Success",
     *                   property="message"),
     *            @OA\Property(
     *                   format="string",
     *                   title="token",
     *                   default="7|p2E0XEiTJBh07vcFgjAvZeQ71msi2qD2NZFEIBsl",
     *                   description="token",
     *                   property="token")
     *          )
     *      )
     * )
     *
     */

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="AuthRegister",
     *      summary="Authentication Register",
     *      tags={"Authentication"},
     *
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="array",
     *              example={
     *                 "name": "demo",
     *                 "email": "demo@parking.id",
     *                 "password": "pass123"
     *              },
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                  )
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="user",
     *                  type="array",
     *                  example={
     *                      "id": 1,
     *                      "name": "demo",
     *                      "email": "demo@parking.id",
     *                      "created_at": "2021-11-18T12:52:12.000000Z",
     *                      "updated_at": "2021-11-18T12:52:12.000000Z"
     *              },
     *              @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="email",
     *                         type="string",
     *                      ),
     *                      @OA\Property(
     *                         property="created_at",
     *                         type="datetime",
     *                      ),
     *                      @OA\Property(
     *                         property="updated_at",
     *                         type="datetime",
     *                      )
     *                  )
     *               ),
     *               @OA\Property(
     *                   format="string",
     *                   title="message",
     *                   default="New user created",
     *                   description="Success",
     *                   property="message"),
     *               @OA\Property(
     *                   format="string",
     *                   title="token",
     *                   default="7|p2E0XEiTJBh07vcFgjAvZeQ71msi2qD2NZFEIBsl",
     *                   description="token",
     *                   property="token")
     *          )
     *      )
     * )
     *
     */


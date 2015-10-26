DEC - Doctrine Entity Creator
=======================

Introduction
------------
Conveniently create your Doctrine 2 entity code, save entity files, load them for editing and create database tables on your local server.

Installation
------------
Clone the repository and run `composer install`

Create entities
------------
- Define all the association types: One-To-One, One-To-Many and Many-To-Many (including self-referencing relationships), select the owning/inverse sides and configure cascading operations
- Make use of the @IndexBy annotation
- Define indexes and columns indexed by them
- Assign repository class to an entity
- For entity fields you can define whether the field is nullable, unsigned, unique and specify its default value.
- Set the primary field and choose your Identifier Generation Strategy
- Preview your code before saving your entities

Edit your saved entities
------------
- Along with PHP entity files, DEC saves their JSON representation. Select the entity class you want to edit and entity data will be loaded into the form. Make a backup of the JSON files for your entities and make use of them in the future when you need to make edits.

Create a locahost database based on your entities
------------
- DEC enables you to create database schema on your localhost for the namespace your entity files share. Once you’re done creating all the entity files, provide DEC with your localhost database access data and upon submission, the database schema will be created for you.
- Before creating localhost database schema, DEC lets you see all the SQL for the creation of your tables. If you’re not completely satisfied with the way Doctrine Schema Tool generates the SQL, you can copy it, tweak it and run it against your database manually.
